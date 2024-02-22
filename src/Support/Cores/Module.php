<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\ProviderRepository;

class Module
{
    public string $namespace = 'AdminModules';
    public string $dir       = 'admin-modules';

    public function register()
    {
        $namespace = 'AdminModules';
        $modules   = $this->allModules(true);

        if (blank($modules)) {
            return;
        }

        $serviceProviders = collect($modules)
            ->map(fn($i) => sprintf('%s\\%s\\%sServiceProvider', $namespace, $i, $i))
            ->filter(fn($i) => class_exists($i))
            ->all();

        (new ProviderRepository(app(), new Filesystem(), app()->getCachedServicesPath()))->load($serviceProviders);
    }

    public function allModules($onlyEnabled = false)
    {
        $modules = config('admin.modules', []);

        if ($onlyEnabled) {
            $modules = array_filter($modules);
        }

        return array_keys($modules);
    }

    public function has($module)
    {
        return in_array($module, $this->allModules()) || file_exists($this->getModulePath($module));
    }

    public function getModulePath($module = null)
    {
        return base_path($this->dir) . '/' . $module;
    }

    public function getLowerName($module)
    {
        return Str::snake($module);
    }

    public function allRoutePath()
    {
        $path = [];
        if ($modules = $this->allModules(true)) {
            foreach ($modules as $module) {
                $_path = $this->getModulePath($module . '/routes.php');

                if (file_exists($_path)) {
                    $path[] = $_path;
                }
            }
        }

        return $path;
    }

    public function allConfigPath()
    {
        $path = [];
        if ($modules = $this->allModules(true)) {
            foreach ($modules as $module) {
                $_path = $this->getModulePath($module . '/config.php');

                if (file_exists($_path)) {
                    $path[$this->getLowerName($module) . '.admin'] = $_path;
                }
            }
        }

        return $path;
    }
}
