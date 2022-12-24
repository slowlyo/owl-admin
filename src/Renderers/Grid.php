<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Grid 格子布局渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/grid
 *
 * @method self columns($value) 列集合
 * @method self visible($value) 是否显示
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self static($value) 是否静态展示
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticSchema($value) 
 * @method self className($value) 容器 css 类名
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self gap($value) 水平间距 可选值: xs | sm | base | none | md | lg | 
 * @method self disabledOn($value) 是否禁用表达式
 * @method self onEvent($value) 事件动作配置
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self type($value) 指定为 Grid 格子布局渲染器。
 * @method self align($value) 水平对齐方式 可选值: left | right | between | center | 
 * @method self disabled($value) 是否禁用
 * @method self hidden($value) 是否隐藏
 * @method self visibleOn($value) 是否显示表达式
 * @method self valign($value) 垂直对齐方式 可选值: top | middle | bottom | between | 
 */
class Grid extends BaseRenderer
{
    public string $type = 'grid';
}
