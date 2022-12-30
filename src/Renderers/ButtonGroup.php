<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Button Group 渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/button-group
 *
 * @method self visibleOn($value) 通过 JS 表达式来配置当前表单项是否显示
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self buttons($value) 按钮集合
 * @method self vertical($value) 垂直展示？
 * @method self visible($value) 是否显示
 * @method self disabled($value) 是否为禁用状态。
 * @method self hidden($value) 是否隐藏
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self staticSchema($value) 
 * @method self btnClassName($value) 
 * @method self btnLevel($value) 按钮样式级别
 * @method self btnActiveLevel($value) 按钮选中的样式级别
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self onEvent($value) 事件动作配置
 * @method self static($value) 是否静态展示
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self type($value) 指定为提交按钮类型
 * @method self size($value) 按钮大小 可选值: xs | sm | md | lg | 
 * @method self className($value) 容器 css 类名
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self btnActiveClassName($value) 
 * @method self tiled($value) 平铺展示？
 * @method self disabledOn($value) 通过 JS 表达式来配置当前表单项的禁用状态。
 */
class ButtonGroup extends BaseRenderer
{
    public string $type = 'button-group';
}
