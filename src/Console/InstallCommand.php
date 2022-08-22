<?php

namespace Slowlyo\SlowAdmin\Console;

use Illuminate\Console\Command;
use Slowlyo\SlowAdmin\Models\AdminUser;
use Slowlyo\SlowAdmin\Models\AdminTablesSeeder;

class InstallCommand extends Command
{
    protected $signature = 'admin:install';

    protected $description = '安装 SlowAdmin';

    public function handle()
    {
        $this->initDatabase();
        $this->initAdminDirectory();
    }

    public function initDatabase(): void
    {
        $this->call('migrate');

        if (AdminUser::count() == 0) {
            $this->call('db:seed', ['--class' => AdminTablesSeeder::class]);
        }
    }

    protected function setDirectory()
    {
        $this->directory = config('admin.directory');
    }

    protected function initAdminDirectory()
    {
        $this->setDirectory();

        if (is_dir($this->directory)) {
            $this->warn("{$this->directory} directory already exists !");

            return;
        }

        $this->makeDir('/');
        $this->line('<info>Admin directory was created:</info> ' . str_replace(base_path(), '', $this->directory));

        $this->makeDir('Controllers');


        $this->createAuthController();
        $this->createBootstrapFile();
        $this->createRoutesFile();
        $this->createHomeController();
    }

    protected function makeDir($path = '')
    {
        $this->laravel['files']->makeDirectory("{$this->directory}/$path", 0755, true, true);
    }

    public function createAuthController(): void
    {
        $authController = $this->directory . '/Controllers/AuthController.php';
        $contents       = $this->getStub('AuthController');
        $this->laravel['files']->put(
            $authController,
            str_replace('{{Namespace}}', $this->getNamespace('Controllers'), $contents)
        );
        $this->line('<info>AuthController file was created:</info> ' . str_replace(base_path(), '', $authController));
    }

    protected function createBootstrapFile()
    {
        $file = $this->directory . '/bootstrap.php';

        $contents = $this->getStub('bootstrap');
        $this->laravel['files']->put($file, $contents);
        $this->line('<info>Bootstrap file was created:</info> ' . str_replace(base_path(), '', $file));
    }

    protected function createRoutesFile()
    {
        $file = $this->directory . '/routes.php';

        $contents = $this->getStub('routes');
        $this->laravel['files']->put($file,
            str_replace('{{Namespace}}', $this->getNamespace('Controllers'), $contents));
        $this->line('<info>Routes file was created:</info> ' . str_replace(base_path(), '', $file));
    }

    public function createHomeController(): void
    {
        $homeController = $this->directory . '/Controllers/HomeController.php';
        $contents       = $this->getStub('HomeController');
        $this->laravel['files']->put(
            $homeController,
            str_replace('{{Namespace}}', config('admin.route.namespace'), $contents)
        );
        $this->line('<info>HomeController file was created:</info> ' . str_replace(base_path(), '', $homeController));
    }

    protected function getNamespace($name = null): string
    {
        $base = str_replace('\\Controllers', '\\', config('admin.route.namespace'));

        return trim($base, '\\') . ($name ? "\\{$name}" : '');
    }

    protected function getStub($name): string
    {
        return $this->laravel['files']->get(__DIR__ . "/stubs/{$name}.stub");
    }
}
