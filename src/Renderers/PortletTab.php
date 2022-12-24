<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * 栏目容器渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/portlet
 *
 * @method self hidden($value) 是否隐藏
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self icon($value) 按钮图标
 * @method self iconPosition($value)  可选值: left | right | 
 * @method self disabled($value) 是否禁用
 * @method self disabledOn($value) 是否禁用表达式
 * @method self static($value) 是否静态展示
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self title($value) Tab 标题
 * @method self tab($value) 内容
 * @method self mountOnEnter($value) 点开时才加载卡片内容
 * @method self visible($value) 是否显示
 * @method self onEvent($value) 事件动作配置
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self toolbar($value) 可以在右侧配置点其他功能按钮，随着tab切换而切换
 * @method self body($value) 内容
 * @method self className($value) 容器 css 类名
 * @method self reload($value) 设置以后内容每次都会重新渲染
 * @method self unmountOnExit($value) 卡片隐藏就销毁卡片节点。
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticSchema($value) 
 */
class PortletTab extends BaseRenderer
{
}
