<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Action 行为按钮 https://aisuda.bce.baidu.com/amis/zh-CN/components/action
 *
 * @author  slowlyo
 * @version 6.6.0
 */
class Action extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'action');
    }

    /**
     * 【必填】这是 action 最核心的配置，来指定该 action 的作用类型 可选值: ajax | link | url | drawer | dialog | confirm | cancel | prev | next | copy | close
     */
    public function actionType($value = '')
    {
        return $this->set('actionType', $value);
    }

    /**
     * 给按钮高亮添加类名。
     */
    public function activeClassName($value = '')
    {
        return $this->set('activeClassName', $value);
    }

    /**
     * 按钮高亮时的样式，配置支持同level。
     */
    public function activeLevel($value = '')
    {
        return $this->set('activeLevel', $value);
    }

    /**
     *
     */
    public function api($value = '')
    {
        return $this->set('api', $value);
    }

    /**
     * 添加类名。
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 当action配置在dialog或drawer的actions中时，配置为true指定此次操作完后关闭当前dialog或drawer。当值为字符串，并且是祖先层弹框的名字的时候，会把祖先弹框关闭掉。
     */
    public function close($value = '')
    {
        return $this->set('close', $value);
    }

    /**
     * 当设置后，操作在开始前会询问用户。可用 '$[xxx]' 取值。
     */
    public function confirmText($value = '')
    {
        return $this->set('confirmText', $value);
    }

    /**
     * 被禁用后鼠标停留时弹出该段文字，也可以配置对象类型：字段为title和content。可用 '$[xxx]' 取值。
     */
    public function disabledTip($value = '')
    {
        return $this->set('disabledTip', $value);
    }

    /**
     * 设置图标，例如fa fa-plus。
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    /**
     * 给图标上添加类名。
     */
    public function iconClassName($value = '')
    {
        return $this->set('iconClassName', $value);
    }

    /**
     * 按钮文本。可用 '$[xxx]' 取值。
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 按钮样式，支持：link /primary/secondary/info/success/warning/danger/light/dark/default。
     */
    public function level($value = '')
    {
        return $this->set('level', $value);
    }

    /**
     *
     */
    public function link($value = '')
    {
        return $this->set('link', $value);
    }

    /**
     * 指定此次操作完后，需要刷新的目标组件名字（组件的name值，自己配置的），多个请用, 号隔开。
     */
    public function reload($value = '')
    {
        return $this->set('reload', $value);
    }

    /**
     * 配置字符串数组，指定在form中进行操作之前，需要指定的字段名的表单项通过验证
     */
    public function required($value = '')
    {
        return $this->set('required', $value);
    }

    /**
     * 在按钮文本右侧设置图标，例如fa fa-plus。
     */
    public function rightIcon($value = '')
    {
        return $this->set('rightIcon', $value);
    }

    /**
     * 给右侧图标上添加类名。
     */
    public function rightIconClassName($value = '')
    {
        return $this->set('rightIconClassName', $value);
    }

    /**
     * 按钮大小，支持：xs、sm、md、lg。 可选值: xs | sm | md | lg
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
    }

    /**
     * 鼠标停留时弹出该段文字，也可以配置对象类型：字段为title和content。可用 '$[xxx]' 取值。
     */
    public function tooltip($value = '')
    {
        return $this->set('tooltip', $value);
    }

    /**
     * 如果配置了tooltip或者disabledTip，指定提示信息位置，可配置top、bottom、left、right。
     */
    public function tooltipPlacement($value = '')
    {
        return $this->set('tooltipPlacement', $value);
    }

    /**
     * 指定为 action 渲染器。
     */
    public function type($value = 'action')
    {
        return $this->set('type', $value);
    }


}
