<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self actions($value) 
 * @method self body($value) 内容区域
 * @method self desc($value) 描述
 * @method self disabled($value) 是否禁用
 * @method self visible($value) 是否显示
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self onEvent($value) 事件动作配置
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self staticSchema($value) 
 * @method self avatar($value) 图片地址
 * @method self className($value) 容器 css 类名
 * @method self hidden($value) 是否隐藏
 * @method self remark($value) tooltip 说明
 * @method self title($value) 标题
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self actionsPosition($value) 操作位置，默认在右侧，可以设置成左侧。 可选值: left | right | 
 * @method self subTitle($value) 副标题
 * @method self static($value) 是否静态展示
 */
class ListItem extends BaseRenderer
{
}
