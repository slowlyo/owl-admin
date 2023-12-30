<?php

namespace Slowlyo\OwlAdmin\Console\Module;

use Illuminate\Console\Command;
use Nwidart\Modules\Facades\Module;
use Slowlyo\OwlAdmin\Support\Cores\Module as AdminModule;

class UpdateCommand extends Command
{
    protected $signature = 'admin-module:update';

    protected $description = 'Update Admin Module';

    public function handle(): void
    {
        if (!AdminModule::installed()) {
            $this->error('Please install nwidart/laravel-modules first');
            $this->info('Usage: composer require nwidart/laravel-modules');
            exit;
        }

        $this->updateViews();

        $this->info('Update success');
    }

    protected function updateViews()
    {
        $modules = config('admin.modules');

        if (blank($modules)) {
            $this->warn('No modules, please check config: [admin.modules]');
            return;
        }

        if (is_file(public_path('admin-assets/index.html'))) {
            $content = file_get_contents(public_path('admin-assets/index.html'));
        } else {
            $content = file_get_contents(base_path('vendor/slowlyo/owl-admin/admin-views/dist/index.html'));
        }

        foreach ($modules as $module) {
            $module = Module::find(ucfirst($module));

            $script = '<script>window.$adminApiPrefix = "/' . $module->getLowerName() . '-api"</script>';

            $content = preg_replace('/<script>window.*?<\/script>/is', $script, $content);

            $_path = AdminModule::getModulePath($module->getName(), '/Resources');

            file_put_contents($_path . '/views/index.blade.php', $content);
        }
    }
}
