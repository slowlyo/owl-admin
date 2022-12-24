<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * 提示渲染器，默认会显示个小图标，鼠标放上来的时候显示配置的内容。
 *
 * @method self staticSchema($value) 
 * @method self trigger($value) 触发规则
 * @method self title($value) 提示标题
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self label($value) 
 * @method self tooltipClassName($value) 
 * @method self content($value) 提示内容
 * @method self visible($value) 是否显示
 * @method self shape($value) icon的形状 可选值: circle | square | 
 * @method self disabled($value) 是否禁用
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self type($value) 指定为提示类型
 * @method self staticOn($value) 是否静态展示表达式
 * @method self icon($value) 
 * @method self placement($value) 显示位置 可选值: top | right | bottom | left | 
 * @method self disabledOn($value) 是否禁用表达式
 * @method self onEvent($value) 事件动作配置
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self hidden($value) 是否隐藏
 * @method self static($value) 是否静态展示
 * @method self rootClose($value) 点击其他内容时是否关闭弹框信息
 * @method self className($value) 容器 css 类名
 * @method self id($value) 组件唯一 id，主要用于日志采集
 */
class Remark extends BaseRenderer
{
    public string $type = 'remark';
}
