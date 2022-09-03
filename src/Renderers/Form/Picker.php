<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>Picker 列表选择器</b><br/>
 * 列表选取，在功能上和 Select 类似，但它能显示更复杂的信息。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/picker
 *
 * @method self options($value) 选项组
 * @method self source($value) 动态选项组
 * @method self multiple($value = true) 是否为多选。
 * @method self delimiter($value) 拼接符
 * @method self labelField($value) 选项标签字段
 * @method self valueField($value) 选项值字段
 * @method self joinValues($value = true) 拼接值
 * @method self extractValue($value = true) 提取值
 * @method self autoFill($value) 自动填充
 * @method self modalMode($value) 设置 dialog 或者 drawer，用来配置弹出方式。
 * @method self pickerSchema($value) 即用 List 类型的渲染，来展示列表信息。更多配置参考 CRUD
 * @method self embed($value = true) 是否使用内嵌模式
 */
class Picker extends FormItem
{
    public string $type = 'picker';
}
