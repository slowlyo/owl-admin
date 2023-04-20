<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * AnchorNav 锚点导航渲染器 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/anchor-nav
 *
 * @method self type($value) 指定为 AnchorNav 锚点导航渲染器
 * @method self sectionClassName($value) 楼层样式名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hidden($value) 是否隐藏
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self onEvent($value) 事件动作配置
 * @method self static($value) 是否静态展示
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visible($value) 是否显示
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self disabled($value) 是否禁用
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self links($value) 楼层集合
 * @method self linkClassName($value) 导航样式名
 * @method self className($value) 样式名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self staticSchema($value) 
 * @method self active($value) 被激活（定位）的楼层
 * @method self direction($value)  可选值: vertical | horizontal | 
 */
class AnchorNav extends BaseRenderer
{
    public string $type = 'anchor-nav';
}
