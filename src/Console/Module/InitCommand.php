<?php

namespace Slowlyo\OwlAdmin\Console\Module;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Console\Command;
use Slowlyo\OwlAdmin\Support\Cores\Database;

class InitCommand extends Command
{
    protected $signature = 'admin-module:init {module*}';

    protected $description = 'Init Admin Module';

    protected string $module;

    protected string $directory;

    public function handle(): void
    {
        $modules = $this->checkOption();

        foreach ($modules as $module) {
            $this->module = $module;

            $this->output->title('Init Module: ' . $module);
            $this->initDB();
            $this->initAdminDirectory();
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
            if (Admin::module()->has($module)) {
                $this->error("Module [{$module}] already exists");
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

        $this->line('<info>AuthController file was created:</info> ' . str_replace(base_path(), '', $path));
    }

    protected function createBootstrapFile()
    {
        $path = $this->getPath('/bootstrap.php');

        $this->laravel['files']->put($path, $this->getStub('bootstrap'));

        $this->line('<info>Bootstrap file was created:</info> ' . str_replace(base_path(), '', $path));
    }

    protected function createServiceProvider()
    {
        $path = $this->getPath('/' . $this->module . 'ServiceProvider.php');

        $content = str_replace(
            '{{Namespace}}', 
            Admin::module()->namespace . "\\{$this->module}", 
            $this->getStub('ServiceProvider')
        );
        $this->laravel['files']->put($path, $content);

        $this->line('<info>ServiceProvider file was created:</info> ' . str_replace(base_path(), '', $path));
    }

    protected function createRoutesFile()
    {
        $path = $this->getPath('/routes.php');

        $content = $this->getStub('routes');
        $content = str_replace('{{Namespace}}', $this->getNamespace('Controllers'), $content);
        $content = str_replace('{{module}}', $this->getLowerName(), $content);

        $this->laravel['files']->put($path, $content);

        $this->line('<info>Routes file was created:</info> ' . str_replace(base_path(), '', $path));
    }

    public function createHomeController(): void
    {
        $path = $this->getPath('/Controllers/HomeController.php');

        $this->laravel['files']->put(
            $path,
            str_replace('{{Namespace}}', $this->getNamespace('Controllers'), $this->getStub('HomeController'))
        );

        $this->line('<info>HomeController file was created:</info> ' . str_replace(base_path(), '', $path));
    }

    public function createSettingController()
    {
        $path = $this->getPath('/Controllers/SettingController.php');

        $this->laravel['files']->put(
            $path,
            str_replace('{{Namespace}}', $this->getNamespace('Controllers'), $this->getStub('SettingController'))
        );

        $this->line('<info>SettingController file was created:</info> ' . str_replace(base_path(), '', $path));
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

        $this->line('<info>Config file was created:</info> ' . str_replace(base_path(), '', $path));
    }

    protected function createModel()
    {
        $run = function ($name) {
            $file     = $this->getPath("/Models/{$name}.php");
            $contents = $this->getStub($name);
            $content  = str_replace('{{Namespace}}', $this->getNamespace('Models'), $contents);
            $content  = str_replace('{{module}}', $this->getLowerName(), $content);

            $this->laravel['files']->put($file, $content);

            $this->line('<info>' . $name . ' file was created:</info> ' . str_replace(base_path(), '', $file));
        };

        $run('AdminMenu');
        $run('AdminPermission');
        $run('AdminRole');
        $run('AdminUser');
    }
}
