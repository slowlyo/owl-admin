<?php

namespace Slowlyo\OwlAdmin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Models\AdminMenu;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Throwable;

class MenuCommand extends Command
{
    protected $signature = 'admin:menu
        {action=list : list|show|create|update|delete|export|import}
        {id? : 菜单 ID}
        {--title= : 菜单标题}
        {--url= : 菜单 URL}
        {--parent=0 : 父级菜单 ID}
        {--icon= : 菜单图标}
        {--type=1 : URL 类型: 1路由 2外链 3iframe 4页面}
        {--component= : 页面组件或自定义组件}
        {--iframe-url= : iframe 地址}
        {--order=0 : 排序值}
        {--visible=1 : 是否显示}
        {--home=0 : 是否首页}
        {--keep-alive=0 : 是否缓存}
        {--full=0 : 是否完整页面}
        {--extension= : 扩展标识}
        {--file= : 导入或导出 JSON 文件}
        {--force : 跳过删除或导入确认}';

    protected $description = 'Manage OwlAdmin menus from CLI.';

    protected AdminMenuService $service;

    /**
     * 执行菜单维护命令，所有写入都复用现有菜单服务，保持后台页面和 CLI 校验一致。
     */
    public function handle(AdminMenuService $service): int
    {
        $this->service = $service;
        $action = $this->argument('action');

        try {
            return match ($action) {
                'list'   => $this->showList(),
                'show'   => $this->showDetail(),
                'create' => $this->createMenu(),
                'update' => $this->updateMenu(),
                'delete' => $this->deleteMenu(),
                'export' => $this->exportMenus(),
                'import' => $this->importMenus(),
                default  => $this->failAction($action),
            };
        } catch (Throwable $e) {
            // 菜单命令直接操作系统菜单，失败时输出明确原因并阻止继续写入。
            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }

    /**
     * 输出扁平菜单树，保留层级缩进，便于终端快速定位菜单 ID。
     */
    protected function showList(): int
    {
        $menus = $this->menuModel()::query()->orderBy('custom_order')->orderBy('id')->get()->toArray();
        $rows = $this->flattenMenus($this->buildTree($menus));

        $this->table(['ID', 'Title', 'URL', 'Type', 'Visible', 'Home', 'Order'], $rows);

        return self::SUCCESS;
    }

    /**
     * 输出单个菜单完整字段，用于修改前确认当前值。
     */
    protected function showDetail(): int
    {
        $menu = $this->findMenu();

        if (!$menu) {
            return self::FAILURE;
        }

        $this->table(['Field', 'Value'], collect($menu->toArray())->map(fn($value, $key) => [$key, $value])->all());

        return self::SUCCESS;
    }

    /**
     * 创建菜单，未传入的字段使用数据库默认值或框架约定默认值。
     */
    protected function createMenu(): int
    {
        $data = $this->payload(false);
        $this->service->store($data);

        $this->info('菜单创建成功');

        return self::SUCCESS;
    }

    /**
     * 更新菜单，只提交 CLI 显式传入的字段，避免覆盖未关注的菜单配置。
     */
    protected function updateMenu(): int
    {
        $menu = $this->findMenu();

        if (!$menu) {
            return self::FAILURE;
        }

        $data = $this->payload(true);

        if (blank($data)) {
            $this->warn('没有可更新的字段');

            return self::SUCCESS;
        }

        $this->service->update($menu->getKey(), $data);
        $this->info('菜单更新成功');

        return self::SUCCESS;
    }

    /**
     * 删除菜单前检查子菜单，防止留下断层菜单；强制删除也只删除当前菜单。
     */
    protected function deleteMenu(): int
    {
        $menu = $this->findMenu();

        if (!$menu) {
            return self::FAILURE;
        }

        $childCount = $this->menuModel()::query()->where('parent_id', $menu->getKey())->count();

        if ($childCount > 0) {
            $this->error("该菜单存在 {$childCount} 个子菜单，请先处理子菜单");

            return self::FAILURE;
        }

        if (!$this->option('force') && !$this->confirm("确认删除菜单 [{$menu->id}] {$menu->title} ?")) {
            $this->warn('已取消删除');

            return self::SUCCESS;
        }

        DB::connection($menu->getConnectionName())->transaction(function () use ($menu) {
            $permissionModel = Admin::adminPermissionModel();

            $permissionModel::query()->whereHas('menus', fn($query) => $query->whereKey($menu->getKey()))
                ->get()
                ->each(fn($permission) => $permission->menus()->detach($menu->getKey()));

            $menu->delete();
        });

        $this->info('菜单删除成功');

        return self::SUCCESS;
    }

    /**
     * 导出菜单 JSON，默认输出到终端，传入 --file 时写入指定文件。
     */
    protected function exportMenus(): int
    {
        $menus = $this->menuModel()::query()->orderBy('custom_order')->orderBy('id')->get()->toArray();
        $json = json_encode($menus, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $file = $this->option('file');

        if (blank($file)) {
            $this->line($json);

            return self::SUCCESS;
        }

        file_put_contents($file, $json . PHP_EOL);
        $this->info("菜单已导出: {$file}");

        return self::SUCCESS;
    }

    /**
     * 从 JSON 导入菜单，使用事务保证失败时不产生半截菜单数据。
     */
    protected function importMenus(): int
    {
        $file = $this->option('file');

        if (blank($file) || !is_file($file)) {
            $this->error('请通过 --file 指定有效 JSON 文件');

            return self::FAILURE;
        }

        $menus = json_decode(file_get_contents($file), true);

        if (!is_array($menus)) {
            $this->error('JSON 文件格式不正确');

            return self::FAILURE;
        }

        if (!$this->option('force') && !$this->confirm('导入会按文件内容 upsert 菜单，是否继续?')) {
            $this->warn('已取消导入');

            return self::SUCCESS;
        }

        DB::connection($this->menuModelInstance()->getConnectionName())->transaction(function () use ($menus) {
            foreach ($menus as $menu) {
                $this->upsertMenu($menu);
            }
        });

        $this->info('菜单导入成功');

        return self::SUCCESS;
    }

    /**
     * 组装菜单写入数据，区分创建和更新，避免 update 时把未传选项改成默认值。
     */
    protected function payload(bool $onlyProvided): array
    {
        $map = [
            'title'      => 'title',
            'url'        => 'url',
            'parent'     => 'parent_id',
            'icon'       => 'icon',
            'type'       => 'url_type',
            'component'  => 'component',
            'iframe-url' => 'iframe_url',
            'order'      => 'custom_order',
            'visible'    => 'visible',
            'home'       => 'is_home',
            'keep-alive' => 'keep_alive',
            'full'       => 'is_full',
            'extension'  => 'extension',
        ];

        $data = [];

        foreach ($map as $option => $column) {
            if ($onlyProvided && !$this->hasOptionValue($option)) {
                continue;
            }

            $value = $this->option($option);

            if ($value === null) {
                continue;
            }

            $data[$column] = $this->castValue($column, $value);
        }

        return $data;
    }

    /**
     * 导入单条菜单，存在 id 时更新，不存在时创建，保留原始 ID 方便权限关系迁移。
     */
    protected function upsertMenu(array $data): void
    {
        $columns = $this->service->getTableColumns();
        $data = Arr::only($data, $columns);
        $id = Arr::pull($data, 'id');

        if ($id && $this->menuModel()::query()->whereKey($id)->exists()) {
            $this->service->update($id, $data);

            return;
        }

        if ($id) {
            $data['id'] = $id;
        }

        $this->service->store($data);
    }

    /**
     * 查找当前命令指定的菜单，缺少 ID 或数据不存在时直接输出错误。
     */
    protected function findMenu(): ?AdminMenu
    {
        $id = $this->argument('id');

        if (blank($id)) {
            $this->error('请输入菜单 ID');

            return null;
        }

        $menu = $this->menuModel()::query()->find($id);

        if (!$menu) {
            $this->error("菜单不存在: {$id}");

            return null;
        }

        return $menu;
    }

    /**
     * 构建菜单树，终端展示时使用，避免依赖 request 过滤条件。
     */
    protected function buildTree(array $menus, int $parentId = 0): array
    {
        return collect($menus)
            ->where('parent_id', $parentId)
            ->map(function ($menu) use ($menus) {
                $menu['children'] = $this->buildTree($menus, (int)$menu['id']);

                return $menu;
            })
            ->values()
            ->all();
    }

    /**
     * 将树形菜单转换为终端表格行，缩进只用于展示，不改变真实标题。
     */
    protected function flattenMenus(array $menus, int $level = 0): array
    {
        $rows = [];

        foreach ($menus as $menu) {
            $rows[] = [
                $menu['id'],
                str_repeat('  ', $level) . $menu['title'],
                $menu['url'],
                $menu['url_type'],
                $menu['visible'],
                $menu['is_home'],
                $menu['custom_order'],
            ];

            if (!empty($menu['children'])) {
                $rows = array_merge($rows, $this->flattenMenus($menu['children'], $level + 1));
            }
        }

        return $rows;
    }

    /**
     * 判断选项是否由用户显式传入，解决 Symfony 默认值无法区分的问题。
     */
    protected function hasOptionValue(string $name): bool
    {
        return collect($_SERVER['argv'] ?? [])->contains(fn($arg) => $arg === "--{$name}" || str_starts_with($arg, "--{$name}="));
    }

    /**
     * 转换字段类型，保持 CLI 入参和数据库字段语义一致。
     */
    protected function castValue(string $column, mixed $value): mixed
    {
        if (in_array($column, ['parent_id', 'url_type', 'custom_order', 'visible', 'is_home', 'keep_alive', 'is_full'])) {
            return (int)$value;
        }

        return $value;
    }

    /**
     * 获取菜单模型类，支持项目通过配置替换默认模型。
     */
    protected function menuModel(): string
    {
        return Admin::adminMenuModel();
    }

    /**
     * 获取菜单模型实例，用于读取连接名等运行时信息。
     */
    protected function menuModelInstance(): AdminMenu
    {
        $model = $this->menuModel();

        return new $model;
    }

    /**
     * 处理未知 action，明确提示可用值，减少 CLI 试错成本。
     */
    protected function failAction(string $action): int
    {
        $this->error("未知操作: {$action}");
        $this->line('可用操作: list, show, create, update, delete, export, import');

        return self::FAILURE;
    }
}
