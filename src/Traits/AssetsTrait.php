<?php

namespace Slowlyo\OwlAdmin\Traits;

trait AssetsTrait
{
    /**
     * @return \Slowlyo\OwlAdmin\Support\Cores\Asset;
     */
    public static function asset()
    {
        return app('admin.asset');
    }

    /**
     * 加载 js 文件
     *
     * @param $js
     *
     * @return \Slowlyo\OwlAdmin\Support\Cores\Asset
     */
    public static function js($js = null)
    {
        return static::asset()->js($js);
    }

    /**
     * 加载 css 文件
     *
     * @param $css
     *
     * @return \Slowlyo\OwlAdmin\Support\Cores\Asset
     */
    public static function css($css = null)
    {
        return static::asset()->css($css);
    }

    /**
     * 加载 js 脚本
     *
     * @param $scripts
     *
     * @return \Slowlyo\OwlAdmin\Support\Cores\Asset
     */
    public static function scripts($scripts = null)
    {
        return static::asset()->scripts($scripts);
    }

    /**
     * 加载样式表
     *
     * @param $styles
     *
     * @return \Slowlyo\OwlAdmin\Support\Cores\Asset
     */
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

    /**
     * 在后面添加 Nav
     *
     * @param $appendNav
     *
     * @return \Slowlyo\OwlAdmin\Support\Cores\Asset
     */
    public static function appendNav($appendNav = null)
    {
        return static::asset()->appendNav($appendNav);
    }

    /**
     * 在前面添加 Nav
     *
     * @param $prependNav
     *
     * @return \Slowlyo\OwlAdmin\Support\Cores\Asset
     */
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
