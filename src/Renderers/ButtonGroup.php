<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Button Group 渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/button-group
 *
 * @author  slowlyo
 * @version v3.5.1
 */
class ButtonGroup extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'button-group');


    }

    /**
     *
     */
    public function btnActiveClassName($value = '')
    {
        return $this->set('btnActiveClassName', $value);
    }

    /**
     * 按钮选中的样式级别
     */
    public function btnActiveLevel($value = '')
    {
        return $this->set('btnActiveLevel', $value);
    }

    /**
     *
     */
    public function btnClassName($value = '')
    {
        return $this->set('btnClassName', $value);
    }

    /**
     * 按钮样式级别
     */
    public function btnLevel($value = '')
    {
        return $this->set('btnLevel', $value);
    }

    /**
     * 按钮集合
     */
    public function buttons($value = '')
    {
        return $this->set('buttons', $value);
    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 是否为禁用状态。
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 通过 JS 表达式来配置当前表单项的禁用状态。
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
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
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 按钮大小 可选值: xs | sm | md | lg
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
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
     * 平铺展示？
     */
    public function tiled($value = true)
    {
        return $this->set('tiled', $value);
    }

    /**
     * 指定为提交按钮类型
     */
    public function type($value = 'button-group')
    {
        return $this->set('type', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 垂直展示？
     */
    public function vertical($value = true)
    {
        return $this->set('vertical', $value);
    }

    /**
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 通过 JS 表达式来配置当前表单项是否显示
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
