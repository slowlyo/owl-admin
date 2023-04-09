<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Card 卡片渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/card
 *
 * @method self disabled($value) 是否禁用
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self toolbar($value) 工具栏按钮
 * @method self actions($value) 底部按钮集合。
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visible($value) 是否显示
 * @method self onEvent($value) 事件动作配置
 * @method self type($value) 指定为 card 类型
 * @method self header($value) 头部配置
 * @method self visibleOn($value) 是否显示表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self staticSchema($value) 
 * @method self body($value) 内容区域
 * @method self media($value) 多媒体区域
 * @method self secondary($value) 次要说明
 * @method self className($value) 容器 css 类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hidden($value) 是否隐藏
 * @method self static($value) 是否静态展示
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self useCardLabel($value) 卡片内容区的表单项label是否使用Card内部的样式，默认为true
 */
class Card extends BaseRenderer
{
    public string $type = 'card';
}
