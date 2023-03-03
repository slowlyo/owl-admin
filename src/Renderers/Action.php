<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * <b>Action 行为按钮</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/action
 *
 * @method self actionType($value) 【必填】这是 action 最核心的配置，来指定该 action 的作用类型，支持：ajax、link、url、drawer、dialog、confirm、cancel、prev、next、copy、close。
 * @method self label($value) 按钮文本。可用 '${xxx}' 取值。
 * @method self level($value) 按钮样式，支持：link /primary/secondary/info/success/warning/danger/light/dark/default。
 * @method self size($value) 按钮大小，支持：xs、sm、md、lg。
 * @method self icon($value) 设置图标，例如fa fa-plus。
 * @method self iconClassName($value) 给图标上添加类名。
 * @method self rightIcon($value) 在按钮文本右侧设置图标，例如fa fa-plus。
 * @method self rightIconClassName($value) 给右侧图标上添加类名。
 * @method self className($value) 添加类名。
 * @method self active($value) 按钮是否高亮。
 * @method self activeLevel($value) 按钮高亮时的样式，配置支持同level。
 * @method self activeClassName($value) 给按钮高亮添加类名。
 * @method self block($value) 用display:"block"来显示按钮。
 * @method self confirmText($value) 当设置后，操作在开始前会询问用户。可用 '${xxx}' 取值。
 * @method self reload($value) 指定此次操作完后，需要刷新的目标组件名字（组件的name值，自己配置的），多个请用, 号隔开。
 * @method self tooltip($value) 鼠标停留时弹出该段文字，也可以配置对象类型：字段为title和content。可用 '${xxx}' 取值。
 * @method self disabledTip($value) 被禁用后鼠标停留时弹出该段文字，也可以配置对象类型：字段为title和content。可用 '${xxx}' 取值。
 * @method self tooltipPlacement($value) 如果配置了tooltip或者disabledTip，指定提示信息位置，可配置top、bottom、left、right。
 * @method self close($value) 当action配置在dialog或drawer的actions中时，配置为true指定此次操作完后关闭当前dialog或drawer。当值为字符串，并且是祖先层弹框的名字的时候，会把祖先弹框关闭掉。
 * @method self required($value) 配置字符串数组，指定在form中进行操作之前，需要指定的字段名的表单项通过验证
 * @method self link($value)
 * @method self api($value)
 */
class Action extends BaseRenderer
{
    public string $type = 'action';
}
