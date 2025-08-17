<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * GridNav 宫格导航
 * 
 * @author slowlyo
 * @version 6.12.0
 */
class GridNav extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'grid-nav');


    }

    /**
     * 是否显示列表项边框
     */
    public function border($value = true)
    {
        return $this->set('border', $value);
    }

    /**
     * 是否将列表项内容居中显示
     */
    public function center($value = true)
    {
        return $this->set('center', $value);
    }

    /**
     * 外层 CSS 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 列数
     */
    public function columnNum($value = '')
    {
        return $this->set('columnNum', $value);
    }

    /**
     * 列表项内容排列的方向，可选值为 horizontal 、vertical 可选值: horizontal | vertical
     */
    public function direction($value = '')
    {
        return $this->set('direction', $value);
    }

    /**
     * 列表项之间的间距，默认单位为px
     */
    public function gutter($value = '')
    {
        return $this->set('gutter', $value);
    }

    /**
     * 图标宽度占比，单位%
     */
    public function iconRatio($value = '')
    {
        return $this->set('iconRatio', $value);
    }

    /**
     * 列表项 css 类名
     */
    public function itemClassName($value = '')
    {
        return $this->set('itemClassName', $value);
    }

    /**
     * 列表项图标
     */
    public function options($value = '')
    {
        return $this->set('options', $value);
    }

    /**
     * 是否调换图标和文本的位置
     */
    public function reverse($value = true)
    {
        return $this->set('reverse', $value);
    }

    /**
     * 数据源
     */
    public function source($value = '')
    {
        return $this->set('source', $value);
    }

    /**
     * 是否将列表项固定为正方形
     */
    public function square($value = true)
    {
        return $this->set('square', $value);
    }

    /**
     * 指定为 grid-nav 渲染器。
     */
    public function type($value = 'grid-nav')
    {
        return $this->set('type', $value);
    }

    /**
     * 图片数组
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
    }


}
