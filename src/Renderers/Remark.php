<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 提示渲染器，默认会显示个小图标，鼠标放上来的时候显示配置的内容。
 * 
 * @author slowlyo
 * @version v3.1.1
 * @since 2023-06-06
 */
class Remark extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'remark');

    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 提示内容
     */
    public function content($value = '')
    {
        return $this->set('content', $value);
    }

    /**
     * 是否禁用
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

    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 显示位置 可选值: top | right | bottom | left
     */
    public function placement($value = '')
    {
        return $this->set('placement', $value);
    }

    /**
     * 点击其他内容时是否关闭弹框信息
     */
    public function rootClose($value = true)
    {
        return $this->set('rootClose', $value);
    }

    /**
     * icon的形状 可选值: circle | square
     */
    public function shape($value = '')
    {
        return $this->set('shape', $value);
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
     * 提示标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    public function tooltipClassName($value = '')
    {
        return $this->set('tooltipClassName', $value);
    }

    /**
     * 触发规则
     */
    public function trigger($value = '')
    {
        return $this->set('trigger', $value);
    }

    /**
     * 指定为提示类型
     */
    public function type($value = 'remark')
    {
        return $this->set('type', $value);
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
