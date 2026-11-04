<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Support\PathGuard;
use Slowlyo\OwlAdmin\Support\Apis\{AggregateApi,
    DataListApi,
    DataCreateApi,
    DataDetailApi,
    DataDeleteApi,
    DataToggleApi,
    DataUpdateApi,
    GetSettingsApi,
    OptionsApi,
    SaveSettingsApi
};

class Api
{
    /**
     * 注册动态接口模板
     *
     * @return void
     */
    public static function boot()
    {
        Admin::context()->set('apis', [
            AggregateApi::class,
            DataListApi::class,
            DataCreateApi::class,
            DataDetailApi::class,
            DataDeleteApi::class,
            DataToggleApi::class,
            DataUpdateApi::class,
            OptionsApi::class,
            GetSettingsApi::class,
            SaveSettingsApi::class,
        ]);

        // 模板目录不存在时，直接跳过自定义模板扫描。
        if (!is_dir(self::path())) {
            return;
        }

        collect(scandir(app_path('/ApiTemplates')))
            ->filter(fn($file) => !in_array($file, ['.', '..']) && str_ends_with($file, '.php'))
            ->each(function ($file) {
                $class = 'App\\ApiTemplates\\' . str_replace('.php', '', $file);
                try {
                    // 仅注册可以正常加载的模板类。
                    if (class_exists($class)) {
                        Admin::context()->add('apis', $class);
                    }
                } catch (\Throwable $e) {
                }
            });
    }

    /**
     * 获取模板目录路径
     *
     * @param string $file
     *
     * @return string
     */
    public static function path($file = '')
    {
        $base = app_path('ApiTemplates');

        if ($file === '' || $file === null) {
            return $base;
        }

        $file = str_replace('\\', '/', (string) $file);

        if (
            str_contains($file, '..') ||
            str_contains($file, '/') ||
            str_contains($file, "\0")
        ) {
            return $base . '/.invalid';
        }

        return $base . '/' . $file;
    }

    /**
     * 根据类短名生成模板文件路径，并校验落在 ApiTemplates 目录内。
     */
    public static function templateFilePath(string $classShortName): string
    {
        if (!PathGuard::isValidPhpClassShortName($classShortName)) {
            return '';
        }

        $file = self::path($classShortName . '.php');

        if (!PathGuard::isPathInsideDirectory($file, self::path())) {
            return '';
        }

        return $file;
    }
}
