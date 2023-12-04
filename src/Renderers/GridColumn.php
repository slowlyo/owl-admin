<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * GridColumn
 *
 * @author  slowlyo
 * @version v3.6.1
 */
class GridColumn extends BaseRenderer
{
    public function __construct()
    {


    }

    /**
     *
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 列类名
     */
    public function columnClassName($value = '')
    {
        return $this->set('columnClassName', $value);
    }

    /**
     * 如果是水平排版，这个属性可以细化水平排版的左右宽度占比。
     */
    public function horizontal($value = '')
    {
        return $this->set('horizontal', $value);
    }

    /**
     * 大屏时(>=1200px)宽度占比
     */
    public function lg($value = '')
    {
        return $this->set('lg', $value);
    }

    /**
     * 中屏时(>=992px)宽度占比
     */
    public function md($value = '')
    {
        return $this->set('md', $value);
    }

    /**
     * 配置子表单项默认的展示方式。 可选值: normal | inline | horizontal
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 小屏时（>=768px）宽度占比
     */
    public function sm($value = '')
    {
        return $this->set('sm', $value);
    }

    /**
     * 样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 垂直对齐方式 可选值: top | middle | bottom | between
     */
    public function valign($value = '')
    {
        return $this->set('valign', $value);
    }

    /**
     * 极小屏（<768px）时宽度占比
     */
    public function xs($value = '')
    {
        return $this->set('xs', $value);
    }


}
