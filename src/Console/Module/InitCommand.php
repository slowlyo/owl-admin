<?php

namespace Slowlyo\OwlAdmin\Console\Module;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Console\Command;
use Slowlyo\OwlAdmin\Support\Cores\Database;

class InitCommand extends Command
{
    protected $signature = 'admin-module:init {module*} {--force : Confirm module database table creation}';

    protected $description = 'Init Admin Module';

    protected string $module;

    protected string $directory;

    /**
     * 初始化模块文件和数据库，新模块首次创建时仍允许直接执行，force 用于脚本化确认。
     */
    public function handle(): int
    {
        $modules = $this->checkOption();

        foreach ($modules as $module) {
            $this->module = $module;

            $this->output->title(admin_trans('admin.console.module_init_title', ['module' => $module]));

            if (!$this->option('force') && !$this->confirm(admin_trans('admin.console.module_init_confirm', ['module' => $module]))) {
                // 模块初始化包含建表和写文件，用户取消时不能继续生成半成品。
                $this->warn(admin_trans('admin.console.module_skipped', ['module' => $module]));

                continue;
            }

            $this->initDB();
            $this->initAdminDirectory();
        }

        return self::SUCCESS;
    }

    public function initDB()
    {
        $prefix = rtrim($this->getLowerName(), '_') . '_';

        Database::make($prefix)->initSchema();
        Database::make($prefix)->fillInitialData();
    }

    public function checkOption()
    {
        $modules = $this->argument('module');

        if (blank($modules)) {
            $this->error(admin_trans('admin.console.module_name_required'));
            $this->info(admin_trans('admin.console.module_init_usage'));
            exit;
        }

        foreach ($modules as $module) {
            if (Admin::module()->has($module)) {
                $this->error(admin_trans('admin.console.module_exists', ['module' => $module]));
                exit;
            }
        }

        return $modules;
    }

    protected function setDirectory()
    {
        $this->directory = Admin::module()->getModulePath($this->module);

        $this->makeDir('Models');
        $this->makeDir('Controllers');
        $this->makeDir('Services');
    }

    protected function getLowerName()
    {
        return Admin::module()->getLowerName($this->module);
    }

    protected function initAdminDirectory()
    {
        $this->setDirectory();

        $this->createAuthController();
        $this->createServiceProvider();
        $this->createBootstrapFile();
        $this->createRoutesFile();
        $this->createHomeController();
        $this->createSettingController();
        $this->createConfig();
        $this->createModel();
    }

    private function makeDir($path = '')
    {
        $this->laravel['files']->makeDirectory("{$this->directory}/$path", 0755, true, true);
    }

    public function getPath($path)
    {
        return $this->directory . $path;
    }

    protected function getNamespace($name = null): string
    {
        return Admin::module()->namespace . "\\{$this->module}\\{$name}";
    }

    protected function getStub($name): string
    {
        return $this->laravel['files']->get(__DIR__ . "/stubs/{$name}.stub");
    }

    public function createAuthController(): void
    {
        $path = $this->getPath('/Controllers/AuthController.php');

        $this->laravel['files']->put(
            $path,
            str_replace('{{Namespace}}', $this->getNamespace('Controllers'), $this->getStub('AuthController'))
        );

        $this->line('<info>' . admin_trans('admin.console.file_created', ['name' => 'AuthController']) . '</info> ' . str_replace(base_path(), '', $path));
    }

    protected function createBootstrapFile()
    {
        $path = $this->getPath('/bootstrap.php');

        $this->laravel['files']->put($path, $this->getStub('bootstrap'));

        $this->line('<info>' . admin_trans('admin.console.file_created', ['name' => 'Bootstrap']) . '</info> ' . str_replace(base_path(), '', $path));
    }

    protected function createServiceProvider()
    {
        $path = $this->getPath('/' . $this->module . 'ServiceProvider.php');

        $content = str_replace(
            ['{{Namespace}}', '{{module}}'],
            [Admin::module()->namespace . "\\{$this->module}", $this->module],
            $this->getStub('ServiceProvider')
        );
        $this->laravel['files']->put($path, $content);

        $this->line('<info>' . admin_trans('admin.console.file_created', ['name' => 'ServiceProvider']) . '</info> ' . str_replace(base_path(), '', $path));
    }

    protected function createRoutesFile()
    {
        $path = $this->getPath('/routes.php');

        $content = $this->getStub('routes');
        $content = str_replace('{{Namespace}}', $this->getNamespace('Controllers'), $content);
        $content = str_replace('{{module}}', $this->getLowerName(), $content);

        $this->laravel['files']->put($path, $content);

        $this->line('<info>' . admin_trans('admin.console.file_created', ['name' => 'Routes']) . '</info> ' . str_replace(base_path(), '', $path));
    }

    public function createHomeController(): void
    {
        $path = $this->getPath('/Controllers/HomeController.php');

        $this->laravel['files']->put(
            $path,
            str_replace('{{Namespace}}', $this->getNamespace('Controllers'), $this->getStub('HomeController'))
        );

        $this->line('<info>' . admin_trans('admin.console.file_created', ['name' => 'HomeController']) . '</info> ' . str_replace(base_path(), '', $path));
    }

    public function createSettingController()
    {
        $path = $this->getPath('/Controllers/SettingController.php');

        $this->laravel['files']->put(
            $path,
            str_replace('{{Namespace}}', $this->getNamespace('Controllers'), $this->getStub('SettingController'))
        );

        $this->line('<info>' . admin_trans('admin.console.file_created', ['name' => 'SettingController']) . '</info> ' . str_replace(base_path(), '', $path));
    }

    protected function createConfig()
    {
        $path     = $this->getPath("/config.php");
        $contents = $this->getStub('config');
        $_path    = sprintf('%s/%s/bootstrap.php', Admin::module()->dir, $this->module);
        $_path = str_replace(base_path(), '', $_path);

        $content = str_replace('{{bootstrap}}', 'base_path(\'' . $_path . '\')', $contents);
        $content = str_replace('{{route_prefix}}', $this->getLowerName() . '-api', $content);
        $content = str_replace('{{module_name}}', $this->getLowerName(), $content);
        $content = str_replace('{{route_namespace}}', $this->getNamespace('Controllers'), $content);
        $content = str_replace('{{model_namespace}}', $this->getNamespace('Models'), $content);

        $this->laravel['files']->put($path, $content);

        $this->line('<info>' . admin_trans('admin.console.file_created', ['name' => 'Config']) . '</info> ' . str_replace(base_path(), '', $path));
    }

    protected function createModel()
    {
        $run = function ($name) {
            $file     = $this->getPath("/Models/{$name}.php");
            $contents = $this->getStub($name);
            $content  = str_replace('{{Namespace}}', $this->getNamespace('Models'), $contents);
            $content  = str_replace('{{module}}', $this->getLowerName(), $content);

            $this->laravel['files']->put($file, $content);

            $this->line('<info>' . admin_trans('admin.console.file_created', ['name' => $name]) . '</info> ' . str_replace(base_path(), '', $file));
        };

        $run('AdminMenu');
        $run('AdminPermission');
        $run('AdminRole');
        $run('AdminUser');
    }
}
