<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * JSON 数据展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/json
 *
 * @method self hidden($value) 是否隐藏
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticSchema($value) 
 * @method self mutable($value) 是否可修改
 * @method self quotesOnKeys($value) 是否显示键的引号
 * @method self staticOn($value) 是否静态展示表达式
 * @method self type($value) 指定为Json展示类型 可选值: json | static-json | 
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visible($value) 是否显示
 * @method self sortKeys($value) 是否为键排序
 * @method self ellipsisThreshold($value) 设置字符串的最大展示长度，超出长度阈值的字符串将被截断，点击value可切换字符串展示方式，默认为false
 * @method self disabledOn($value) 是否禁用表达式
 * @method self levelExpand($value) 默认展开的级别
 * @method self enableClipboard($value) 是否可复制
 * @method self visibleOn($value) 是否显示表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self onEvent($value) 事件动作配置
 * @method self static($value) 是否静态展示
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self displayDataTypes($value) 是否显示数据类型
 * @method self className($value) 容器 css 类名
 * @method self disabled($value) 是否禁用
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self source($value) 支持从数据链取值
 * @method self iconStyle($value) 图标风格 可选值: square | circle | triangle | 
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 */
class Json extends BaseRenderer
{
    public string $type = 'json';
}
