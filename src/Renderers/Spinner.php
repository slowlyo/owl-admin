<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self onEvent($value) 事件动作配置
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self icon($value) 自定义icon
 * @method self body($value) 作为容器使用时内容
 * @method self className($value) 自定义spinner的class
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self spinnerClassName($value) spin图标位置包裹元素的自定义class
 * @method self spinnerWrapClassName($value) 作为容器使用时最外层元素的class
 * @method self disabled($value) 是否禁用
 * @method self staticSchema($value) 
 * @method self tip($value) spinner文案
 * @method self overlay($value) 是否显示遮罩层
 * @method self hidden($value) 是否隐藏
 * @method self visible($value) 是否显示
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self type($value) 组件类型
 * @method self show($value) 控制Spinner显示与隐藏
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self mode($value) 
 * @method self size($value) spinner Icon 大小 可选值: sm | lg |  | 
 * @method self disabledOn($value) 是否禁用表达式
 * @method self visibleOn($value) 是否显示表达式
 * @method self static($value) 是否静态展示
 * @method self tipPlacement($value) spinner文案位置 可选值: top | right | bottom | left | 
 * @method self delay($value) 延迟显示
 */
class Spinner extends BaseRenderer
{
    public string $type = 'spinner';
}
