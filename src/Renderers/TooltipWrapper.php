<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * TooltipWrapper
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class TooltipWrapper extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'tooltip-wrapper');
    }

    /**
     * 内容区域 (内容区域)
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 内容区CSS类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 文字提示内容，兼容 tooltip，但建议通过 content 来实现提示内容
     */
    public function content($value = '')
    {
        return $this->set('content', $value);
    }

    /**
     * 是否禁用提示
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式 (表达式，语法 `${xxx > 5}`。)
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
     * 是否可以移入浮层中, 默认true
     */
    public function enterable($value = true)
    {
        return $this->set('enterable', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `${xxx > 5}`。)
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
     * 内容区是否内联显示，默认为false
     */
    public function inline($value = true)
    {
        return $this->set('inline', $value);
    }

    /**
     * 浮层延迟显示时间, 单位 ms
     */
    public function mouseEnterDelay($value = '')
    {
        return $this->set('mouseEnterDelay', $value);
    }

    /**
     * 浮层延迟隐藏时间, 单位 ms
     */
    public function mouseLeaveDelay($value = '')
    {
        return $this->set('mouseLeaveDelay', $value);
    }

    /**
     * 浮层位置相对偏移量
     */
    public function offset($value = '')
    {
        return $this->set('offset', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 文字提示浮层出现位置，默认为top 可选值: top | right | bottom | left
     */
    public function placement($value = '')
    {
        return $this->set('placement', $value);
    }

    /**
     * 是否点击非内容区域关闭提示，默认为true
     */
    public function rootClose($value = true)
    {
        return $this->set('rootClose', $value);
    }

    /**
     * 是否展示浮层指向箭头
     */
    public function showArrow($value = true)
    {
        return $this->set('showArrow', $value);
    }

    /**
     * 是否静态展示
     */
    public function static($value = true)
    {
        return $this->set('static', $value);
    }

    /**
     * 静态展示表单项类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 静态展示表单项Value类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 静态展示表单项Label类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 是否静态展示表达式 (表达式，语法 `${xxx > 5}`。)
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
     * 内容区自定义样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 
     */
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 文字提示标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 提示文字内容
     */
    public function tooltip($value = '')
    {
        return $this->set('tooltip', $value);
    }

    /**
     * 箭头CSS类名
     */
    public function tooltipArrowClassName($value = '')
    {
        return $this->set('tooltipArrowClassName', $value);
    }

    /**
     * 文字提示浮层CSS类名
     */
    public function tooltipClassName($value = '')
    {
        return $this->set('tooltipClassName', $value);
    }

    /**
     * 自定义提示浮层样式
     */
    public function tooltipStyle($value = '')
    {
        return $this->set('tooltipStyle', $value);
    }

    /**
     * 主题样式， 默认为light 可选值: light | dark
     */
    public function tooltipTheme($value = '')
    {
        return $this->set('tooltipTheme', $value);
    }

    /**
     * 浮层触发方式，默认为hover 可选值: click | hover
     */
    public function trigger($value = '')
    {
        return $this->set('trigger', $value);
    }

    /**
     * 文字提示容器
     */
    public function type($value = 'tooltip-wrapper')
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
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }

    /**
     * 内容区包裹标签
     */
    public function wrapperComponent($value = '')
    {
        return $this->set('wrapperComponent', $value);
    }


}
