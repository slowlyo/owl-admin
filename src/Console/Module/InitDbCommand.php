<?php

namespace Slowlyo\OwlAdmin\Console\Module;

use Illuminate\Console\Command;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Support\Cores\Database;

class InitDbCommand extends Command
{
    protected $signature = 'admin-module:init-db
        {module*}
        {--force : Confirm rebuilding module database tables}
        {--seed-only : Only refill initial data without recreating tables}';

    protected $description = 'Init Admin Module Database';

    protected string $module;

    protected string $directory;

    /**
     * 初始化模块数据库；默认拒绝无确认重建表，避免误删模块数据。
     */
    public function handle(): int
    {
        $modules = $this->checkOption();

        foreach ($modules as $module) {
            $this->module = $module;

            $this->output->title(admin_trans('admin.console.module_init_title', ['module' => $module]));

            if (!$this->option('seed-only') && !$this->option('force') && !$this->confirm(admin_trans('admin.console.module_rebuild_confirm', ['module' => $module]))) {
                // initSchema 会先 drop 再 create，必须让用户明确确认。
                $this->warn(admin_trans('admin.console.module_skipped', ['module' => $module]));

                continue;
            }

            $this->initDB();
        }

        return self::SUCCESS;
    }

    /**
     * 初始化模块数据表和默认数据，seed-only 模式只重填默认数据。
     */
    public function initDB()
    {
        $prefix = rtrim($this->getLowerName(), '_') . '_';

        if (!$this->option('seed-only')) {
            Database::make($prefix)->initSchema();
        }

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
            if (!Admin::module()->has($module)) {
                $this->error(admin_trans('admin.console.module_not_exists', ['module' => $module]));
                exit;
            }
        }

        return $modules;
    }

    protected function getLowerName()
    {
        return Admin::module()->getLowerName($this->module);
    }
}
