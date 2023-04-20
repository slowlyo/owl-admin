<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Mapping 映射展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/mapping
 *
 * @method self type($value) 指定为映射展示控件 可选值: map | mapping | 
 * @method self labelField($value) map或source为对象数组时，作为label值的字段名
 * @method self className($value) 容器 css 类名
 * @method self disabled($value) 是否禁用
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self map($value) 配置映射规则，值可以使用模板语法。当 key 为 * 时表示 else，也就是说值没有映射到任何规则时用 * 对应的值展示。
 * @method self static($value) 是否静态展示
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hidden($value) 是否隐藏
 * @method self visible($value) 是否显示
 * @method self staticSchema($value) 
 * @method self name($value) 关联字段名。
 * @method self valueField($value) map或source为对象数组时，作为value值的字段名
 * @method self placeholder($value) 占位符
 * @method self onEvent($value) 事件动作配置
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self itemSchema($value) 自定义渲染映射值，支持html或schema
 * @method self source($value) 如果想远程拉取字典，请配置 source 为接口。
 */
class Mapping extends BaseRenderer
{
    public string $type = 'map';
}
