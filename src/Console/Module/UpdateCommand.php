<?php

namespace Slowlyo\OwlAdmin\Console\Module;

use Illuminate\Console\Command;
use Nwidart\Modules\Facades\Module;

class UpdateCommand extends Command
{
    protected $signature = 'admin-module:update';

    protected $description = 'Update Admin Module';

    public function handle(): void
    {
        $this->updateViews();

        $this->info('Update success');
    }

    protected function updateViews()
    {
        $modules = config('admin.modules');

        if (blank($modules)) {
            return;
        }

        if (is_file(public_path('admin/index.html'))) {
            $content = file_get_contents(public_path('admin/index.html'));
        } else {
            $content = file_get_contents(base_path('vendor/slowlyo/owl-admin/admin-views/dist/index.html'));
        }

        foreach ($modules as $module) {
            $module  = Module::find(ucfirst($module));
            $script  = '<script>window.$adminApiPrefix = "/' . $module->getLowerName() . '-api"</script>';
            $content = preg_replace('/<script>window.*?<\/script>/is', $script, $content);

            file_put_contents($module->getPath() . '/Resources/views/index.blade.php', $content);
        }
    }
}
