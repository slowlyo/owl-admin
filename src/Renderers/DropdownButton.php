<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * 下拉按钮渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/dropdown-button
 *
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hidden($value) 是否隐藏
 * @method self size($value) 按钮大小 可选值: xs | sm | md | lg | 
 * @method self iconOnly($value) 是否只显示图标。
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self block($value) 是否独占一行 `display: block`
 * @method self trigger($value) 触发条件，默认是 click 可选值: click | hover | 
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self buttons($value) 按钮集合，支持分组
 * @method self closeOnOutside($value) 点击外部是否关闭
 * @method self closeOnClick($value) 点击内容是否关闭
 * @method self menuClassName($value) 菜单 CSS 样式
 * @method self visible($value) 是否显示
 * @method self type($value) 指定为 DropDown Button 类型
 * @method self label($value) 按钮文字
 * @method self align($value) 对齐方式 可选值: left | right | 
 * @method self rightIcon($value) 右侧图标
 * @method self className($value) 容器 css 类名
 * @method self static($value) 是否静态展示
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticSchema($value) 
 * @method self level($value) 按钮级别，样式 可选值: info | success | danger | warning | primary | link | 
 * @method self btnClassName($value) 给 Button 配置 className。
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self hideCaret($value) 是否显示下拉按钮
 * @method self disabled($value) 是否禁用
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visibleOn($value) 是否显示表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self onEvent($value) 事件动作配置
 */
class DropdownButton extends BaseRenderer
{
    public string $type = 'dropdown-button';
}
