<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Illuminate\Support\Str;
use Slowlyo\OwlAdmin\Support\Composer;

class Module
{
    public static function installed()
    {
        return class_exists('Nwidart\Modules\Facades\Module');
    }

    public static function isV10()
    {
        return version_compare(Composer::getVersion('nwidart/laravel-modules'), '10', '>=');
    }

    public static function getModulePath($module, $path, $isApp = false)
    {
        $base = rtrim(config('modules.paths.modules'), '/') . '/' . $module . '/';

        if (self::isV10()) {
            if ($isApp) {
                $base .= 'app/';
            } else {
                $path = Str::lcfirst(ltrim($path, '/'));
            }
        } else {
            $path = Str::ucfirst(ltrim($path, '/'));
        }

        return $base . $path;
    }

    public static function allModules()
    {
        return config('admin.modules');
    }

    public static function allRoutePath()
    {
        $path = [];

        $modules = self::allModules();
        if (self::installed() && $modules) {
            foreach ($modules as $module) {
                $_path = self::getModulePath($module, '/routes/admin.php');

                if (file_exists($_path)) {
                    $path[] = $_path;
                }
            }
        }

        return $path;
    }

    public static function allConfigPath()
    {
        $path = [];

        $modules = self::allModules();
        if (self::installed() && $modules) {
            foreach ($modules as $module) {
                $_path = self::getModulePath($module, '/config/admin.php');

                if (file_exists($_path)) {
                    $path[strtolower($module) . '.admin'] = $_path;
                }
            }
        }

        return $path;
    }
}
