<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self disabled($value) 是否禁用提示
 * @method self visible($value) 是否显示
 * @method self content($value) 文字提示内容，兼容 tooltip，但建议通过 content 来实现提示内容
 * @method self mouseEnterDelay($value) 浮层延迟显示时间, 单位 ms
 * @method self offset($value) 浮层位置相对偏移量
 * @method self showArrow($value) 是否展示浮层指向箭头
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self title($value) 文字提示标题
 * @method self tooltip($value) 
 * @method self enterable($value) 是否可以移入浮层中, 默认true
 * @method self tooltipClassName($value) 文字提示浮层CSS类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self placement($value) 文字提示浮层出现位置，默认为top 可选值: top | right | bottom | left | 
 * @method self mouseLeaveDelay($value) 浮层延迟隐藏时间, 单位 ms
 * @method self rootClose($value) 是否点击非内容区域关闭提示，默认为true
 * @method self className($value) 内容区CSS类名
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self onEvent($value) 事件动作配置
 * @method self staticSchema($value) 
 * @method self inline($value) 内容区是否内联显示，默认为false
 * @method self style($value) 内容区自定义样式
 * @method self visibleOn($value) 是否显示表达式
 * @method self type($value) 文字提示容器
 * @method self trigger($value) 浮层触发方式，默认为hover
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self static($value) 是否静态展示
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self tooltipTheme($value) 主题样式， 默认为light 可选值: light | dark | 
 * @method self tooltipStyle($value) 自定义提示浮层样式
 * @method self hidden($value) 是否隐藏
 * @method self body($value) 内容区域
 * @method self wrapperComponent($value) 内容区包裹标签
 */
class TooltipWrapper extends BaseRenderer
{
    public string $type = 'tooltip-wrapper';
}
