<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * HBoxColumn
 *
 * @author  slowlyo
 * @version v6.0.0
 */
class HBoxColumn extends BaseRenderer
{
    public function __construct()
    {


    }

    /**
     * 内容区
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 列上 CSS 类名
     */
    public function columnClassName($value = '')
    {
        return $this->set('columnClassName', $value);
    }

    /**
     * 高度
     */
    public function height($value = '')
    {
        return $this->set('height', $value);
    }

    /**
     * 如果是水平排版，这个属性可以细化水平排版的左右宽度占比。
     */
    public function horizontal($value = '')
    {
        return $this->set('horizontal', $value);
    }

    /**
     * 配置子表单项默认的展示方式。 可选值: normal | inline | horizontal
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 其他样式
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
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }

    /**
     * 宽度
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }


}
