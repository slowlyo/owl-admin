<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Panel渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/panel
 *
 * @method self type($value) 指定为Panel渲染器。
 * @method self title($value) Panel 标题
 * @method self subFormMode($value) 配置子表单项默认的展示方式。 可选值: normal | inline | horizontal | 
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self className($value) 容器 css 类名
 * @method self static($value) 是否静态展示
 * @method self disabled($value) 是否禁用
 * @method self hidden($value) 是否隐藏
 * @method self footerWrapClassName($value) footer 和 actions 外层 div 类名。
 * @method self footer($value) 底部内容区域
 * @method self footerClassName($value) 配置 footer 容器 className
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self actions($value) 按钮集合
 * @method self bodyClassName($value) 配置 Body 容器 className
 * @method self body($value) 内容区域
 * @method self header($value) 头部内容, 和 title 二选一。
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visible($value) 是否显示
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self actionsClassName($value) 按钮集合外层类名
 * @method self subFormHorizontal($value) 如果是水平排版，这个属性可以细化水平排版的左右宽度占比。
 * @method self disabledOn($value) 是否禁用表达式
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self affixFooter($value) 固定底部, 想要把按钮固定在底部的时候配置。
 * @method self onEvent($value) 事件动作配置
 * @method self staticSchema($value) 
 * @method self headerClassName($value) 配置 header 容器 className
 */
class Panel extends BaseRenderer
{
    public string $type = 'panel';
}
