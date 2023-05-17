<?php

namespace Slowlyo\OwlAdmin\Traits;

trait Assets
{
    /**
     * @return \Slowlyo\OwlAdmin\Libs\Asset;
     */
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

    public static function appendNav($appendNav = null)
    {
        return static::asset()->appendNav($appendNav);
    }

    public static function prependNav($prependNav = null)
    {
        return static::asset()->prependNav($prependNav);
    }

    public static function getNav()
    {
        return [
            'appendNav'  => static::asset()->appendNav(),
            'prependNav' => static::asset()->prependNav(),
        ];
    }
}
