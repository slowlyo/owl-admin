<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self visible($value) 是否显示
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self disabled($value) 是否禁用
 * @method self title($value) Tab 标题
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticOn($value) 是否静态展示表达式
 * @method self badge($value) 徽标
 * @method self unmountOnExit($value) 卡片隐藏就销毁卡片节点。
 * @method self hidden($value) 是否隐藏
 * @method self mountOnEnter($value) 点开时才加载卡片内容
 * @method self mode($value) 配置子表单项默认的展示方式。 可选值: normal | inline | horizontal | 
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self iconPosition($value)  可选值: left | right | 
 * @method self closable($value) 是否可关闭，优先级高于 tabs 的 closable
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticSchema($value) 
 * @method self body($value) 内容
 * @method self className($value) 容器 css 类名
 * @method self visibleOn($value) 是否显示表达式
 * @method self onEvent($value) 事件动作配置
 * @method self tab($value) 内容
 * @method self reload($value) 设置以后内容每次都会重新渲染
 * @method self horizontal($value) 如果是水平排版，这个属性可以细化水平排版的左右宽度占比。
 * @method self static($value) 是否静态展示
 * @method self hash($value) 设置以后将跟url的hash对应
 * @method self icon($value) 按钮图标
 * @method self hiddenOn($value) 是否隐藏表达式
 */
class Tab extends BaseRenderer
{
}
