<?php

namespace Slowlyo\OwlAdmin\Console\Module;

use Illuminate\Console\Command;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Support\Cores\Database;

class InitDbCommand extends Command
{
    protected $signature = 'admin-module:init-db {module*}';

    protected $description = 'Init Admin Module Database';

    protected string $module;

    protected string $directory;

    public function handle(): void
    {
        $modules = $this->checkOption();

        foreach ($modules as $module) {
            $this->module = $module;

            $this->output->title('Init Module: ' . $module);
            $this->initDB();
        }
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
            $this->error('Module name is required');
            $this->info('Usage: php artisan admin-module:init ModuleName');
            exit;
        }

        foreach ($modules as $module) {
            if (!Admin::module()->has($module)) {
                $this->error("Module [{$module}] not exists");
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
