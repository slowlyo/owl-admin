<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

class Module
{
    public static function installed()
    {
        return class_exists('Nwidart\Modules\Facades\Module');
    }

    public static function allRoutePath()
    {
        $path = [];

        $modules = config('admin.modules');
        if (self::installed() && $modules) {
            foreach ($modules as $module) {
                $_base = config('modules.paths.modules') . '/' . $module;
                $_path = $_base . '/Routes/admin.php';
                if (is_dir($_base . '/app')) {
                    $_path = $_base . '/routes/admin.php';
                }
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

        $modules = config('admin.modules');
        if (self::installed() && $modules) {
            foreach ($modules as $module) {
                $_base = config('modules.paths.modules') . '/' . $module;
                $_path = $_base . '/Config/admin.php';
                if (is_dir($_base . '/app')) {
                    $_path = $_base . '/config/admin.php';
                }

                if (file_exists($_path)) {
                    $path[strtolower($module) . '.admin'] = $_path;
                }
            }
        }

        return $path;
    }
}
