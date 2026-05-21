<?php

namespace Slowlyo\OwlAdmin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Support\Cores\Database;
use Throwable;

class DoctorCommand extends Command
{
    protected $signature = 'admin:doctor';

    protected $description = 'Check OwlAdmin runtime health.';

    protected bool $hasError = false;
    protected bool $dbConnected = false;

    /**
     * 执行 OwlAdmin 健康检查，覆盖运行前最容易导致后台不可用的基础项。
     */
    public function handle(): int
    {
        $this->checkAppKey();
        $this->checkDatabase();
        $this->checkAdminTables();
        $this->checkMenus();
        $this->checkPublishedAssets();

        if ($this->hasError) {
            return self::FAILURE;
        }

        $this->info(admin_trans('admin.console.doctor_passed'));

        return self::SUCCESS;
    }

    /**
     * 检查 APP_KEY，缺失时登录态和加密能力都会异常。
     */
    protected function checkAppKey(): void
    {
        if (blank(config('app.key'))) {
            $this->failItem(admin_trans('admin.console.doctor_app_key_missing'));

            return;
        }

        $this->passItem(admin_trans('admin.console.doctor_app_key_configured'));
    }

    /**
     * 检查数据库连接，后续表结构和菜单检查都依赖该连接。
     */
    protected function checkDatabase(): void
    {
        if (!Database::isConnected()) {
            $this->failItem(admin_trans('admin.console.doctor_database_failed'));

            return;
        }

        $this->dbConnected = true;
        $this->passItem(admin_trans('admin.console.doctor_database_ok'));
    }

    /**
     * 检查核心表是否存在，用于判断是否已执行 admin:install 或迁移。
     */
    protected function checkAdminTables(): void
    {
        if (!$this->dbConnected) {
            $this->failItem(admin_trans('admin.console.doctor_tables_skipped'));

            return;
        }

        $connection = Admin::config('admin.database.connection') ?: config('database.default');
        $schema = Schema::connection($connection);
        $tables = [
            'admin_users',
            'admin_roles',
            'admin_permissions',
            'admin_menus',
            'admin_permission_menu',
        ];

        try {
            foreach ($tables as $table) {
                if (!$schema->hasTable($table)) {
                    $this->failItem(admin_trans('admin.console.doctor_table_missing', ['table' => $table]));

                    continue;
                }

                $this->passItem(admin_trans('admin.console.doctor_table_exists', ['table' => $table]));
            }
        } catch (Throwable $e) {
            // 数据库连接失败时表结构检查无法继续，保留错误摘要给部署脚本识别。
            $this->failItem(admin_trans('admin.console.doctor_table_check_failed', ['message' => $e->getMessage()]));
        }
    }

    /**
     * 检查菜单数据的常见异常，包括重复 URL、首页数量和断开的父级关系。
     */
    protected function checkMenus(): void
    {
        if (!$this->dbConnected) {
            $this->failItem(admin_trans('admin.console.doctor_menus_skipped'));

            return;
        }

        $model = Admin::adminMenuModel();

        try {
            if (!Schema::connection((new $model)->getConnectionName())->hasTable((new $model)->getTable())) {
                $this->failItem(admin_trans('admin.console.doctor_menu_table_missing'));

                return;
            }

            $duplicateUrls = $model::query()
                ->select('url')
                ->whereNotNull('url')
                ->where('url', '<>', '')
                ->groupBy('url')
                ->havingRaw('count(*) > 1')
                ->pluck('url');

            if ($duplicateUrls->isNotEmpty()) {
                $this->failItem(admin_trans('admin.console.doctor_menu_url_duplicate', ['urls' => $duplicateUrls->implode(', ')]));
            } else {
                $this->passItem(admin_trans('admin.console.doctor_menu_url_unique'));
            }

            $homeCount = $model::query()->where('is_home', 1)->count();

            if ($homeCount !== 1) {
                $this->failItem(admin_trans('admin.console.doctor_home_count_invalid', ['count' => $homeCount]));
            } else {
                $this->passItem(admin_trans('admin.console.doctor_home_count_ok'));
            }

            $ids = $model::query()->pluck('id')->all();
            $brokenParents = $model::query()
                ->where('parent_id', '<>', 0)
                ->whereNotIn('parent_id', $ids)
                ->pluck('id');

            if ($brokenParents->isNotEmpty()) {
                $this->failItem(admin_trans('admin.console.doctor_menu_parent_missing', ['ids' => $brokenParents->implode(', ')]));
            } else {
                $this->passItem(admin_trans('admin.console.doctor_menu_parent_ok'));
            }
        } catch (Throwable $e) {
            // 菜单检查依赖数据库和模型配置，失败时不影响其他 doctor 项继续输出。
            $this->failItem(admin_trans('admin.console.doctor_menu_check_failed', ['message' => $e->getMessage()]));
        }
    }

    /**
     * 检查前端资源是否已发布，避免安装后后台页面空白。
     */
    protected function checkPublishedAssets(): void
    {
        if (!is_dir(public_path('admin-assets'))) {
            $this->failItem(admin_trans('admin.console.doctor_assets_missing'));

            return;
        }

        $this->passItem(admin_trans('admin.console.doctor_assets_published'));
    }

    /**
     * 输出通过项，统一 doctor 命令的终端反馈格式。
     */
    protected function passItem(string $message): void
    {
        $this->info(admin_trans('admin.console.doctor_status_ok', ['message' => $message]));
    }

    /**
     * 输出失败项并标记最终退出码，便于 CI 或部署脚本识别异常。
     */
    protected function failItem(string $message): void
    {
        $this->error(admin_trans('admin.console.doctor_status_fail', ['message' => $message]));
        $this->hasError = true;
    }
}
