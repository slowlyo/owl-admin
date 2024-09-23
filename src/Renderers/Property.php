<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Property 属性表
 *
 * @author  slowlyo
 * @version 6.8.0
 */
class Property extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'property');
    }

    /**
     * 外层 dom 的类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 每行几列
     */
    public function column($value = '')
    {
        return $this->set('column', $value);
    }

    /**
     * 属性值的样式
     */
    public function contentStyle($value = '')
    {
        return $this->set('contentStyle', $value);
    }

    /**
     *
     */
    public function items($value = '')
    {
        return $this->set('items', $value);
    }

    /**
     * 属性名的样式
     */
    public function labelStyle($value = '')
    {
        return $this->set('labelStyle', $value);
    }

    /**
     * 显示模式，目前只有 'table' 和 'simple' 可选值: table | simple
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 模式下属性名和值之间的分隔符
     */
    public function separator($value = '')
    {
        return $this->set('separator', $value);
    }

    /**
     * 数据源
     */
    public function source($value = '')
    {
        return $this->set('source', $value);
    }

    /**
     * 外层 dom 的样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 指定为 property 渲染器。
     */
    public function type($value = 'property')
    {
        return $this->set('type', $value);
    }


}
