<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self source($value) API 或 数据映射
 * @method self name($value) 变量映射
 * @method self visible($value) 是否显示
 * @method self visibleOn($value) 是否显示表达式
 * @method self static($value) 是否静态展示
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self steps($value) 步骤
 * @method self status($value) 
 * @method self labelPlacement($value) 标签放置位置 可选值: horizontal | vertical | 
 * @method self className($value) 容器 css 类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hidden($value) 是否隐藏
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticSchema($value) 
 * @method self type($value) 指定为 Steps 步骤条渲染器
 * @method self value($value) 指定当前步骤
 * @method self mode($value) 展示模式 可选值: horizontal | vertical | 
 * @method self disabled($value) 是否禁用
 * @method self onEvent($value) 事件动作配置
 * @method self progressDot($value) 点状步骤条
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 */
class Steps extends BaseRenderer
{
    public string $type = 'steps';
}
