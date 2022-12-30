<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self size($value) 是弹窗形式的时候有用。 可选值: sm | md | lg | xl | 
 * @method self position($value) 弹出位置 可选值: center | left-top | left-top-left-top | left-top-left-center | left-top-left-bottom | left-top-center-top | left-top-center-center | left-top-center-bottom | left-top-right-top | left-top-right-center | left-top-right-bottom | right-top | right-top-left-top | right-top-left-center | right-top-left-bottom | right-top-center-top | right-top-center-center | right-top-center-bottom | right-top-right-top | right-top-right-center | right-top-right-bottom | left-bottom | left-bottom-left-top | left-bottom-left-center | left-bottom-left-bottom | left-bottom-center-top | left-bottom-center-center | left-bottom-center-bottom | left-bottom-right-top | left-bottom-right-center | left-bottom-right-bottom | right-bottom | right-bottom-left-top | right-bottom-left-center | right-bottom-left-bottom | right-bottom-center-top | right-bottom-center-center | right-bottom-center-bottom | right-bottom-right-top | right-bottom-right-center | right-bottom-right-bottom | fixed-center | fixed-left-top | fixed-right-top | fixed-left-bottom | fixed-right-bottom | 
 * @method self showIcon($value) 是否显示查看更多的 icon，通常是放大图标。
 * @method self offset($value) 偏移量
 * @method self popOverEnableOn($value) 配置当前行是否启动，要用表达式
 * @method self mode($value) 弹出模式 可选值: dialog | drawer | popOver | 
 * @method self trigger($value) 触发条件，默认是 click 可选值: click | hover | 
 * @method self title($value) 标题
 * @method self body($value) 
 * @method self className($value) 类名
 * @method self popOverClassName($value) 弹框外层类名
 */
class SchemaPopOver extends BaseRenderer
{
}
