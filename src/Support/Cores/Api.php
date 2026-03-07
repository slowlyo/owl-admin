<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Slowlyo\OwlAdmin\Admin;
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
        return app_path('/ApiTemplates') . ($file ? '/' . ltrim($file, '/') : '');
    }
}
