<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self visibleOn($value) 是否显示表达式
 * @method self static($value) 是否静态展示
 * @method self scheduleAction($value) 日程点击展示
 * @method self largeMode($value) 是否开启放大模式
 * @method self className($value) 容器 css 类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self visible($value) 是否显示
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticOn($value) 是否静态展示表达式
 * @method self disabled($value) 是否禁用
 * @method self hidden($value) 是否隐藏
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticSchema($value) 
 * @method self type($value) 指定为日历选择控件
 * @method self schedules($value) 日程
 * @method self scheduleClassNames($value) 日程显示颜色自定义
 * @method self onEvent($value) 事件动作配置
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self todayActiveStyle($value) 今日激活时的自定义样式
 */
class Calendar extends BaseRenderer
{
    public string $type = 'calendar';
}
