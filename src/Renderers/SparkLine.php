<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self static($value) 是否静态展示
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self type($value) 
 * @method self width($value) 宽度
 * @method self disabled($value) 是否禁用
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self height($value) 高度
 * @method self disabledOn($value) 是否禁用表达式
 * @method self visible($value) 是否显示
 * @method self visibleOn($value) 是否显示表达式
 * @method self onEvent($value) 事件动作配置
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self name($value) 关联数据变量。
 * @method self clickAction($value) 点击行为
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self value($value) 
 * @method self placeholder($value) 空数据时显示的内容
 * @method self hidden($value) 是否隐藏
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticSchema($value) 
 * @method self className($value) css 类名
 */
class SparkLine extends BaseRenderer
{
    public string $type = 'sparkline';
}
