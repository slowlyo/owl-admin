<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Grid
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Grid extends BaseRenderer
{
    public function __construct()
    {
        

    }

    /**
     * 水平展示方式，用于内容宽度比 grid 小的情况，默认是 auto 自动撑满 可选值: left | right | center | auto
     */
    public function align($value = '')
    {
        return $this->set('align', $value);
    }

    /**
     * 每个格子最外层容器的 className
     */
    public function gridClassName($value = '')
    {
        return $this->set('gridClassName', $value);
    }

    /**
     * 高度，跨几行
     */
    public function h($value = '')
    {
        return $this->set('h', $value);
    }

    /**
     * 高度，会影响起始位置那一行的高度，设置为 auto 就会自适应
     */
    public function height($value = '')
    {
        return $this->set('height', $value);
    }

    /**
     * 垂直展示方式，用于内容高度比 grid 小的情况，默认是 auto 自动撑满 可选值: top | bottom | middle | auto
     */
    public function valign($value = '')
    {
        return $this->set('valign', $value);
    }

    /**
     * 宽度，跨几列
     */
    public function w($value = '')
    {
        return $this->set('w', $value);
    }

    /**
     * 宽度，会影响起始位置对应那一列的宽度
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }

    /**
     * 起始横坐标位置，以 1 为起点
     */
    public function x($value = '')
    {
        return $this->set('x', $value);
    }

    /**
     * 起始纵坐标位置，以 1 为起点
     */
    public function y($value = '')
    {
        return $this->set('y', $value);
    }


}
