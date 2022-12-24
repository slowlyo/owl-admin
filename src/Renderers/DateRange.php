<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * DateRange 展示渲染器。
 *
 * @method self static($value) 是否静态展示
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self type($value) 指定为日期展示类型
 * @method self valueFormat($value) 值的时间格式，参考 moment 中的格式说明。
 * @method self disabled($value) 是否禁用
 * @method self hidden($value) 是否隐藏
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self visible($value) 是否显示
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self staticSchema($value) 
 * @method self delimiter($value) 分割符
 * @method self className($value) 容器 css 类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self connector($value) 连接符
 * @method self onEvent($value) 事件动作配置
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self visibleOn($value) 是否显示表达式
 * @method self format($value) 展示的时间格式，参考 moment 中的格式说明。
 */
class DateRange extends BaseRenderer
{
    public string $type = 'date-range';
}
