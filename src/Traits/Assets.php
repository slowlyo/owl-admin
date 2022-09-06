<?php

namespace Slowlyo\SlowAdmin\Traits;

trait Assets
{
    private static array $css = [
        // 'vendor/admin/static/amis/sdk.css',
        'vendor/admin/static/amis/helper.css',
        'vendor/admin/static/amis/iconfont.css',
        'vendor/admin/static/css/animate.min.css',
        'vendor/admin/static/css/common.css',
        'vendor/admin/static/amis/thirds/tinymce/skins/ui/oxide/skin.css',
    ];

    private static array $js = [
        'vendor/admin/static/amis/sdk.js',
        'vendor/admin/static/js/history.js',
        'vendor/admin/static/js/axios.min.js',
    ];

    /**
     * 添加css
     *
     * @param $css
     *
     * @return void
     */
    public static function css($css): void
    {
        if (is_array($css)) {
            static::$css = array_merge(static::$css, $css);
        } else {
            static::$css[] = $css;
        }
    }

    public function getCss(): array
    {
        $theme = config('admin.layout.theme');
        if (!$theme || $theme == 'default') {
            $theme = 'sdk';
        }

        array_unshift(self::$css, "vendor/admin/static/amis/{$theme}.css");

        return static::$css;
    }

    public static function js($js): void
    {
        if (is_array($js)) {
            static::$js = array_merge(static::$js, $js);
        } else {
            static::$js[] = $js;
        }
    }

    public function getJs(): array
    {
        return static::$js;
    }
}
