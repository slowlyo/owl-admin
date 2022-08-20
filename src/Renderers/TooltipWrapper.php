<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>TooltipWrapper 文字提示容器</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/tooltip
 *
 * @method self title($value) 文字提示标题
 * @method self content($value) 文字提示内容, 兼容之前的 tooltip 属性
 * @method self placement($value) 文字提示浮层出现位置
 * @method self tooltipTheme($value) 主题样式， 默认为 light
 * @method self offset($value) 文字提示浮层位置相对偏移量，单位 px
 * @method self showArrow($value) 是否展示浮层指向箭头
 * @method self enterable($value) 是否鼠标可以移入到浮层中
 * @method self disabled($value) 是否禁用浮层提示
 * @method self trigger($value) 浮层触发方式，支持数组写法["hover", "click"]
 * @method self mouseEnterDelay($value) 浮层延迟展示时间，单位 ms
 * @method self mouseLeaveDelay($value) 浮层延迟隐藏时间，单位 ms
 * @method self rootClose($value) 是否点击非内容区域关闭提示
 * @method self inline($value) 内容区是否内联显示
 * @method self wrapperComponent($value) 容器标签名
 * @method self body($value) 内容容器
 * @method self style($value) 内容区自定义样式
 * @method self tooltipStyle($value) 浮层自定义样式
 * @method self className($value) 内容区类名
 * @method self tooltipClassName($value) 文字提示浮层类名
 */
class TooltipWrapper extends BaseRenderer
{
    public string $type = 'tooltip-wrapper';
}
