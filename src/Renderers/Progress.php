<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 进度展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/progress
 * 
 * @author slowlyo
 * @version v3.1.0
 * @since 2023-06-03
 */
class Progress extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'progress');
        $this->set('mode', 'line');

    }

    /**
     * 是否显示动画（只有在开启的时候才能看出来）
     */
    public function animate($value = true)
    {
        return $this->set('animate', $value);
    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
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
     * 仪表盘进度条缺口角度，可取值 0 ~ 295
     */
    public function gapDegree($value = '')
    {
        return $this->set('gapDegree', $value);
    }

    /**
     * 仪表盘进度条缺口位置 可选值: top | bottom | left | right
     */
    public function gapPosition($value = '')
    {
        return $this->set('gapPosition', $value);
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
     * 配置不同的值段，用不同的样式提示用户
     */
    public function map($value = '')
    {
        return $this->set('map', $value);
    }

    /**
     * 进度条类型 可选值: line | circle | dashboard
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 关联字段名
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 占位符
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 进度条 CSS 类名
     */
    public function progressClassName($value = '')
    {
        return $this->set('progressClassName', $value);
    }

    /**
     * 是否显示值
     */
    public function showLabel($value = true)
    {
        return $this->set('showLabel', $value);
    }

    /**
     * 是否显示阈值数值
     */
    public function showThresholdText($value = true)
    {
        return $this->set('showThresholdText', $value);
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
     * 是否显示背景间隔
     */
    public function stripe($value = true)
    {
        return $this->set('stripe', $value);
    }

    /**
     * 进度条线的宽度
     */
    public function strokeWidth($value = '')
    {
        return $this->set('strokeWidth', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 阈值
     */
    public function threshold($value = '')
    {
        return $this->set('threshold', $value);
    }

    public function type($value = 'progress')
    {
        return $this->set('type', $value);
    }

    /**
     * 进度值
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
    }

    /**
     * 内容的模板函数
     */
    public function valueTpl($value = '')
    {
        return $this->set('valueTpl', $value);
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
