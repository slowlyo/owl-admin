<?php

namespace Slowlyo\OwlAdmin\Console\Module;

use Illuminate\Console\Command;
use Nwidart\Modules\Facades\Module;
use Slowlyo\OwlAdmin\Support\Cores\Database;
use Slowlyo\OwlAdmin\Support\Cores\Module as AdminModule;

class InitCommand extends Command
{
    protected $signature = 'admin-module:init {--module=}';

    protected $description = 'Init Admin Module';

    protected $module;

    protected $moduleVersion = 9;

    protected $directory;

    public function handle(): void
    {
        $this->checkOption();

        // $this->initDB();
        $this->initAdminDirectory();
    }

    public function initDB()
    {
        $prefix = rtrim($this->module->getLowerName(), '_') . '_';

        Database::make($prefix)->initSchema();
        Database::make($prefix)->fillInitialData();
    }

    public function checkOption()
    {
        if (!AdminModule::installed()) {
            $this->error('Please install nwidart/laravel-modules first');
            $this->info('Usage: composer require nwidart/laravel-modules');
            exit;
        }

        $this->module = $this->option('module');

        if (empty($this->module)) {
            $this->error('Module name is required');
            $this->info('Usage: php artisan admin-module:init --module=ModuleName');
            exit;
        }

        if (!Module::has($this->module)) {
            $this->error('Module not found');
            exit;
        }

        $this->module = Module::find($this->module);
    }

    protected function setDirectory()
    {
        $this->directory = $this->module->getPath();
    }

    protected function initAdminDirectory()
    {
        $this->setDirectory();

        if (is_dir($this->directory . '/app')) {
            $this->moduleVersion = 10;
        }

        $this->createAuthController();
        $this->createBootstrapFile();
        $this->createRoutesFile();
        $this->createHomeController();
        $this->createSettingController();
        $this->createViews();
        $this->createConfig();
        $this->createModel();
    }

    private function makeDir($path = '')
    {
        $this->laravel['files']->makeDirectory("{$this->directory}/$path", 0755, true, true);
    }

    private function getAppPath()
    {
        return $this->directory . ($this->moduleVersion == 10 ? '/app' : '');
    }

    public function createAuthController(): void
    {
        $authController = $this->getAppPath() . '/Http/Controllers/AuthController.php';
        $contents       = $this->getStub('AuthController');
        $this->laravel['files']->put(
            $authController,
            str_replace('{{Namespace}}', $this->getNamespace('Http\Controllers'), $contents)
        );
        $this->line('<info>AuthController file was created:</info> ' . str_replace(base_path(), '', $authController));
    }

    protected function createBootstrapFile()
    {
        $file = $this->getAppPath() . '/bootstrap.php';

        $contents = $this->getStub('bootstrap');
        $this->laravel['files']->put($file, $contents);
        $this->line('<info>Bootstrap file was created:</info> ' . str_replace(base_path(), '', $file));
    }

    protected function createRoutesFile()
    {
        $file = $this->directory . ($this->moduleVersion == 10 ? '/routes/admin.php' : '/Routes/admin.php');

        $contents = $this->getStub('routes');
        $content  = str_replace('{{Namespace}}', $this->getNamespace('Http\Controllers'), $contents);
        $content  = str_replace('{{module}}', $this->module->getLowerName(), $content);

        $this->laravel['files']->put($file, $content);
        $this->line('<info>Routes file was created:</info> ' . str_replace(base_path(), '', $file));
    }

    public function createHomeController(): void
    {
        $homeController = $this->getAppPath() . '/Http/Controllers/HomeController.php';
        $contents       = $this->getStub('HomeController');
        $this->laravel['files']->put(
            $homeController,
            str_replace('{{Namespace}}', $this->getNamespace('Http\Controllers'), $contents)
        );
        $this->line('<info>HomeController file was created:</info> ' . str_replace(base_path(), '', $homeController));
    }

    public function createSettingController()
    {
        $settingController = $this->getAppPath() . '/Http/Controllers/SettingController.php';
        $contents          = $this->getStub('SettingController');
        $this->laravel['files']->put(
            $settingController,
            str_replace('{{Namespace}}', $this->getNamespace('Http\Controllers'), $contents)
        );
        $this->line('<info>SettingController file was created:</info> ' . str_replace(base_path(),
                '',
                $settingController));
    }

    protected function getNamespace($name = null): string
    {
        $prefix = $this->moduleVersion == 10 ? 'app\\' : '';

        return config('modules.namespace') . "\\{$this->module->getName()}\\{$prefix}{$name}";
    }

    protected function getStub($name): string
    {
        return $this->laravel['files']->get(__DIR__ . "/stubs/{$name}.stub");
    }

    protected function createViews()
    {
        if (is_file(public_path('admin/index.html'))) {
            $content = file_get_contents(public_path('admin/index.html'));
        } else {
            $content = file_get_contents(base_path('vendor/slowlyo/owl-admin/admin-views/dist/index.html'));
        }

        $script  = '<script>window.$adminApiPrefix = "/' . $this->module->getLowerName() . '-api"</script>';
        $content = preg_replace('/<script>window.*?<\/script>/is', $script, $content);

        file_put_contents($this->directory . '/Resources/views/index.blade.php', $content);
    }

    protected function createConfig()
    {
        $config   = $this->directory . ($this->moduleVersion == 10 ? "/config/admin.php" : "/Config/admin.php");
        $contents = $this->getStub('config');
        $_path    = 'Modules/' . $this->module->getName() . ($this->moduleVersion == 10 ? '/app' : '') . '/bootstrap.php';
        $content  = str_replace('{{bootstrap}}', 'base_path(\'' . $_path . '\')', $contents);
        $content  = str_replace('{{route_prefix}}', $this->module->getLowerName() . '-api', $content);
        $content  = str_replace('{{module_name}}', $this->module->getLowerName(), $content);
        $content  = str_replace('{{route_namespace}}', $this->getNamespace('Http\Controllers'), $content);
        $content  = str_replace('{{model_namespace}}', $this->getNamespace('Models'), $content);

        $this->laravel['files']->put($config, $content);
        $this->line('<info>Config file was created:</info> ' . str_replace(base_path(), '', $config));
    }

    protected function createModel()
    {
        if ($this->moduleVersion == 9) {
            $this->makeDir('Models');
        }

        $run = function ($name) {
            $file     = $this->getAppPath() . "/Models/{$name}.php";
            $contents = $this->getStub($name);
            $content  = str_replace('{{Namespace}}', $this->getNamespace('Models'), $contents);
            $content  = str_replace('{{module}}', $this->module->getLowerName(), $content);

            $this->laravel['files']->put($file, $content);
            $this->line('<info>' . $name . ' file was created:</info> ' . str_replace(base_path(), '', $file));
        };

        $run('AdminMenu');
        $run('AdminPermission');
        $run('AdminRole');
        $run('AdminUser');
    }
}
