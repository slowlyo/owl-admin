<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Support\Apis\{DataListApi, DataCreateApi, DataDetailApi, DataDeleteApi, DataUpdateApi};

class Api
{
    public static function boot()
    {
        Admin::context()->set('apis', [
            DataListApi::class,
            DataCreateApi::class,
            DataDetailApi::class,
            DataDeleteApi::class,
            DataUpdateApi::class,
        ]);

        if (!is_dir(self::path())) {
            return;
        }

        collect(scandir(app_path('/ApiTemplates')))
            ->filter(fn($file) => !in_array($file, ['.', '..']) && str_ends_with($file, '.php'))
            ->each(function ($file) {
                $class = 'App\\ApiTemplates\\' . str_replace('.php', '', $file);
                try {
                    if (class_exists($class)) {
                        Admin::context()->add('apis', $class);
                    }
                } catch (\Throwable $e) {
                }
            });
    }

    public static function path($file = '')
    {
        return app_path('/ApiTemplates') . ($file ? '/' . ltrim($file, '/') : '');
    }
}
