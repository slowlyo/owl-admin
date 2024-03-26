<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\ProviderRepository;

class Module
{
    public string $namespace = '';
    public string $dir       = '';

    public function __construct()
    {
        $this->namespace = config('admin.modules_namespace', 'AdminModules');
        $this->dir       = config('admin.modules_dir', 'admin-modules');
    }

    /**
     * 当前模块
     *
     * @param bool $lower
     *
     * @return mixed|string|null
     */
    public static function current(bool $lower = false)
    {
        $prefix = data_get(explode('/', request()->path()), 0);
        if ($prefix) {
            $m       = app(Module::class);
            $modules = $m->allModules(true);
            if (count($modules)) {
                $_list = collect($modules)
                    ->combine($modules)
                    ->map(fn($item) => config($m->getLowerName($item) . '.admin.route.prefix', ''))
                    ->flip()
                    ->toArray();

                if (key_exists($prefix, $_list)) {
                    return $lower ? $m->getLowerName($_list[$prefix]) : $_list[$prefix];
                }
            }
        }

        return null;
    }

    public function register()
    {
        $modules = $this->allModules(true);

        if (blank($modules)) {
            return;
        }

        $serviceProviders = collect($modules)
            ->map(fn($i) => sprintf('%s\\%s\\%sServiceProvider', $this->namespace, $i, $i))
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
        return $this->dir . '/' . $module;
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
