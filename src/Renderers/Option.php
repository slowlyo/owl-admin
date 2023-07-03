<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Option
 * 
 * @author slowlyo
 * @version v3.2.0
 */
class Option extends BaseRenderer
{
    public function __construct()
    {

    }

    /**
     * 支持嵌套
     */
    public function children($value = '')
    {
        return $this->set('children', $value);
    }

    /**
     * 标记后数据延时加载
     */
    public function defer($value = true)
    {
        return $this->set('defer', $value);
    }

    /**
     * 如果设置了，优先级更高，不设置走 source 接口加载。
     */
    public function deferApi($value = '')
    {
        return $this->set('deferApi', $value);
    }

    /**
     * 描述，部分控件支持
     */
    public function description($value = '')
    {
        return $this->set('description', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 最好不要用！因为有 visible 就够了。
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 用来显示的文字
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 只有设置了 defer 才有意义，内部字段不可以外部设置
     */
    public function loaded($value = true)
    {
        return $this->set('loaded', $value);
    }

    /**
     * 标记正在加载。只有 defer 为 true 时有意义。内部字段不可以外部设置
     */
    public function loading($value = true)
    {
        return $this->set('loading', $value);
    }

    /**
     * 可以用来给 Option 标记个范围，让数据展示更清晰。这个只有在数值展示的时候显示。
     */
    public function scopeLabel($value = '')
    {
        return $this->set('scopeLabel', $value);
    }

    /**
     * 请保证数值唯一，多个选项值一致会认为是同一个选项。
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
    }

    /**
     * 是否可见
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

}
