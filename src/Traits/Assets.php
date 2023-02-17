<?php

namespace Slowlyo\SlowAdmin\Traits;

trait Assets
{
    public static function asset()
    {
        return app('admin.asset');
    }

    public static function js($js = null)
    {
        return static::asset()->js($js);
    }

    public static function css($css = null)
    {
        return static::asset()->css($css);
    }

    public static function scripts($scripts = null)
    {
        return static::asset()->scripts($scripts);
    }

    public static function styles($styles = null)
    {
        return static::asset()->styles($styles);
    }

    public static function getAssets()
    {
        return [
            'js'      => static::asset()->js(),
            'css'     => static::asset()->css(),
            'scripts' => static::asset()->scripts(),
            'styles'  => static::asset()->styles(),
        ];
    }
}
