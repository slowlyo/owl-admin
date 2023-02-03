<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Alert 提示渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/alert
 *
 * @method self visible($value) 是否显示
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self type($value) 指定为提示框类型
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hidden($value) 是否隐藏
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self body($value) 内容区域
 * @method self level($value) 提示类型 可选值: info | warning | success | error | danger | 
 * @method self showCloseButton($value) 是否显示关闭按钮
 * @method self closeButtonClassName($value) 关闭按钮CSS类名
 * @method self className($value) 容器 css 类名
 * @method self disabled($value) 是否禁用
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self onEvent($value) 事件动作配置
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticSchema($value) 
 * @method self static($value) 是否静态展示
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self title($value) 提示框标题
 * @method self showIcon($value) 是否显示ICON
 * @method self icon($value) 左侧图标
 * @method self iconClassName($value) 图标CSS类名
 */
class Alert extends BaseRenderer
{
    public string $type = 'alert';
}
