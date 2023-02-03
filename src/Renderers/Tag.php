<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Tag
 *
 * @method self disabled($value) 是否禁用
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self type($value) 
 * @method self className($value) 类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self icon($value) status模式时候设置的前置图标
 * @method self closable($value) 是否展示关闭按钮
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self static($value) 是否静态展示
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticSchema($value) 
 * @method self label($value) 标签文本内容
 * @method self closeIcon($value) 关闭图标
 * @method self hidden($value) 是否隐藏
 * @method self onEvent($value) 事件动作配置
 * @method self staticOn($value) 是否静态展示表达式
 * @method self style($value) 自定义样式
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self visible($value) 是否显示
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self color($value) 标签颜色
 * @method self checked($value) 是否选中
 * @method self displayMode($value) normal: 面性标签，对应color的背景色 rounded: 线性标签， 对应color的边框 status: 带图标的标签， 图标可以自定义 可选值: normal | rounded | status | 
 * @method self checkable($value) 是否是可选的标签
 */
class Tag extends BaseRenderer
{
    public string $type = 'tag';
}
