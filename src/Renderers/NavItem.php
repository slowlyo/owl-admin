<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * NavItem
 *
 * @author  slowlyo
 * @version v3.5.3
 */
class NavItem extends BaseRenderer
{
    public function __construct()
    {


    }

    /**
     *
     */
    public function active($value = true)
    {
        return $this->set('active', $value);
    }

    /**
     *
     */
    public function children($value = '')
    {
        return $this->set('children', $value);
    }

    /**
     *
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     *
     */
    public function defer($value = true)
    {
        return $this->set('defer', $value);
    }

    /**
     *
     */
    public function deferApi($value = '')
    {
        return $this->set('deferApi', $value);
    }

    /**
     *
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     *
     */
    public function disabledTip($value = '')
    {
        return $this->set('disabledTip', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 图标类名，参考 fontawesome 4。
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     *
     */
    public function key($value = '')
    {
        return $this->set('key', $value);
    }

    /**
     * 文字说明
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     *
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 是否静态展示
     */
    public function static($value = true)
    {
        return $this->set('static', $value);
    }

    /**
     * 静态展示表单项类名
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 静态展示表单项Value类名
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 静态展示表单项Label类名
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 是否静态展示表达式
     */
    public function staticOn($value = '')
    {
        return $this->set('staticOn', $value);
    }

    /**
     * 静态展示空值占位
     */
    public function staticPlaceholder($value = '')
    {
        return $this->set('staticPlaceholder', $value);
    }

    /**
     *
     */
    public function staticSchema($value = '')
    {
        return $this->set('staticSchema', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     *
     */
    public function target($value = '')
    {
        return $this->set('target', $value);
    }

    /**
     *
     */
    public function to($value = '')
    {
        return $this->set('to', $value);
    }

    /**
     *
     */
    public function unfolded($value = true)
    {
        return $this->set('unfolded', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
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


}
