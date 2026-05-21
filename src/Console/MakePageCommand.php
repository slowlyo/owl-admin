<?php

namespace Slowlyo\OwlAdmin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Models\AdminMenu;

class MakePageCommand extends Command
{
    protected $signature = 'admin:make-page
                            {name : 页面类名, 例如 OrderDashboard}
                            {--title= : 菜单和页面标题}
                            {--path= : 后台菜单路径, 例如 /order-dashboard}
                            {--route= : iframe 页面路由, 默认根据 name 生成}
                            {--menu : 同步创建后台菜单}
                            {--parent=0 : 菜单父级 ID}
                            {--icon=iconoir:page : 菜单图标}
                            {--force : 覆盖已存在的控制器和视图文件}';

    protected $description = 'Create a Blade iframe page for OwlAdmin.';

    private string $className;

    private string $title;

    private string $slug;

    private string $menuPath;

    private string $routePath;

    private string $viewName;

    /**
     * 生成 Blade iframe 页面骨架，并按需创建菜单。
     *
     * @return int
     */
    public function handle(): int
    {
        $this->initNames();
        $this->createController();
        $this->createView();
        $this->appendPageRoute();

        if ($this->option('menu')) {
            $this->createMenu();
        }

        $this->info('Iframe page created successfully.');
        $this->line('Menu path: ' . $this->menuPath);
        $this->line('Iframe url: ' . $this->iframeUrl());

        return self::SUCCESS;
    }

    /**
     * 根据输入参数推导类名、路由、视图和菜单路径，确保后续生成文件使用同一套命名。
     *
     * @return void
     */
    private function initNames(): void
    {
        $name = trim($this->argument('name'));
        $this->className = Str::studly($name) . (str_ends_with(Str::studly($name), 'Controller') ? '' : 'Controller');
        $baseName = preg_replace('/Controller$/', '', $this->className);
        $this->slug = Str::kebab($baseName);
        $this->title = $this->option('title') ?: Str::headline($baseName);
        $this->menuPath = '/' . trim($this->option('path') ?: '/' . $this->slug, '/');
        $this->routePath = trim($this->option('route') ?: $this->slug, '/');
        $this->viewName = 'admin.pages.' . str_replace('-', '_', $this->slug);
    }

    /**
     * 创建控制器文件，控制器只负责返回 Blade 视图，业务数据可在该控制器继续扩展。
     *
     * @return void
     */
    private function createController(): void
    {
        $path = $this->controllerPath();

        if (!$this->option('force') && file_exists($path)) {
            $this->warn("Controller already exists: {$path}");

            return;
        }

        $this->makeDirectory(dirname($path));

        $content = str_replace(
            ['{{Namespace}}', '{{ClassName}}', '{{ViewName}}'],
            [$this->controllerNamespace(), $this->className, $this->viewName],
            $this->stub('IframePageController')
        );

        file_put_contents($path, $content);
        $this->line('<info>Controller created:</info> ' . str_replace(base_path(), '', $path));
    }

    /**
     * 创建 Blade 视图文件，默认复用配置里的现有 layout 和 section。
     *
     * @return void
     */
    private function createView(): void
    {
        $path = $this->viewPath();

        if (!$this->option('force') && file_exists($path)) {
            $this->warn("View already exists: {$path}");

            return;
        }

        $this->makeDirectory(dirname($path));

        $content = str_replace(
            ['{{Layout}}', '{{Section}}', '{{Title}}'],
            [Admin::config('admin.iframe_page.layout'), Admin::config('admin.iframe_page.section'), $this->title],
            $this->stub('iframe-page.blade')
        );

        file_put_contents($path, $content);
        $this->line('<info>View created:</info> ' . str_replace(base_path(), '', $path));
    }

    /**
     * 将页面路由写入独立 pages.php，避免覆盖自动生成的 routes/admin.php。
     *
     * @return void
     */
    private function appendPageRoute(): void
    {
        $file = admin_path('pages.php');
        $route = $this->routeLine();

        if (!file_exists($file)) {
            $this->makeDirectory(dirname($file));
            file_put_contents($file, str_replace('_content_', $route . PHP_EOL, $this->stub('pages-route')));
            $this->line('<info>Page routes file created:</info> ' . str_replace(base_path(), '', $file));

            return;
        }

        $content = file_get_contents($file);

        if (str_contains($content, $route)) {
            $this->warn('Route already exists: ' . $this->routePath);

            return;
        }

        $content = preg_replace('/\n\}\);\s*$/', PHP_EOL . $route . PHP_EOL . '});' . PHP_EOL, $content);
        file_put_contents($file, $content);
        $this->line('<info>Route appended:</info> ' . $this->routePath);
    }

    /**
     * 创建 iframe 菜单记录，底层仍使用已有 TYPE_IFRAME，避免引入迁移。
     *
     * @return void
     */
    private function createMenu(): void
    {
        $exists = Admin::adminMenuModel()::query()->where('url', $this->menuPath)->exists();

        if ($exists) {
            $this->warn('Menu already exists: ' . $this->menuPath);

            return;
        }

        Admin::adminMenuModel()::query()->create([
            'parent_id'    => (int) $this->option('parent'),
            'custom_order' => 0,
            'title'        => $this->title,
            'icon'         => $this->option('icon'),
            'url'          => $this->menuPath,
            'url_type'     => AdminMenu::TYPE_IFRAME,
            'visible'      => 1,
            'is_home'      => 0,
            'keep_alive'   => 0,
            'iframe_url'   => $this->iframeUrl(),
            'component'    => 'iframe',
            'is_full'      => 0,
        ]);

        $this->line('<info>Menu created:</info> ' . $this->menuPath);
    }

    /**
     * 生成路由定义行，控制器使用全限定类名便于独立文件直接加载。
     *
     * @return string
     */
    private function routeLine(): string
    {
        return "    \$router->get('{$this->routePath}', [\\{$this->controllerNamespace()}\\{$this->className}::class, 'index']);";
    }

    /**
     * 获取 iframe 访问地址，地址包含后台 API 前缀和自定义页面前缀。
     *
     * @return string
     */
    private function iframeUrl(): string
    {
        return '/' . trim(Admin::config('admin.route.prefix') . '/' . Admin::config('admin.iframe_page.route_prefix') . '/' . $this->routePath, '/');
    }

    /**
     * 获取控制器命名空间，默认沿用 admin.route.namespace。
     *
     * @return string
     */
    private function controllerNamespace(): string
    {
        return trim(Admin::config('admin.iframe_page.namespace') ?: Admin::config('admin.route.namespace'), '\\');
    }

    /**
     * 获取控制器文件路径，路径按命名空间相对 app 目录换算。
     *
     * @return string
     */
    private function controllerPath(): string
    {
        $namespace = $this->controllerNamespace();

        if (str_starts_with($namespace, 'App\\')) {
            $relative = str_replace('\\', DIRECTORY_SEPARATOR, substr($namespace, 4));

            return app_path($relative . DIRECTORY_SEPARATOR . $this->className . '.php');
        }

        return admin_path('Controllers' . DIRECTORY_SEPARATOR . $this->className . '.php');
    }

    /**
     * 获取 Blade 视图文件路径，视图文件名使用下划线避免和目录分隔混淆。
     *
     * @return string
     */
    private function viewPath(): string
    {
        return rtrim(Admin::config('admin.iframe_page.view_path'), DIRECTORY_SEPARATOR)
            . DIRECTORY_SEPARATOR
            . str_replace('-', '_', $this->slug)
            . '.blade.php';
    }

    /**
     * 创建目录，重复执行时保持幂等。
     *
     * @param string $path
     *
     * @return void
     */
    private function makeDirectory(string $path): void
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    /**
     * 读取命令模板文件。
     *
     * @param string $name
     *
     * @return string
     */
    private function stub(string $name): string
    {
        return file_get_contents(__DIR__ . "/stubs/{$name}.stub");
    }
}
