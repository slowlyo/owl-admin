<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputTag 标签选择器</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-tag
 *
 * @method self options($value) 选项组
 * @method self optionsTip($value) "最近您使用的标签"    选项提示
 * @method self source($value) 动态选项组
 * @method self delimiter($value) 拼接符
 * @method self labelField($value) 选项标签字段
 * @method self valueField($value) 选项值字段
 * @method self joinValues($value) 拼接值
 * @method self extractValue($value) 提取值
 * @method self clearable($value) 在有值的时候是否显示一个删除图标在右侧。
 * @method self resetValue($value) 删除后设置此配置项给定的值。
 * @method self max($value) 允许添加的标签的最大数量
 * @method self maxTagLength($value) 单个标签的最大文本长度
 * @method self maxTagCount($value) 标签的最大展示数量，超出数量后以收纳浮层的方式展示，仅在多选模式开启后生效
 * @method self overflowTagPopover($value) 收纳浮层的配置属性，详细配置参考Tooltip
 * @method self enableBatchAdd($value) 是否开启批量添加模式
 * @method self separator($value) 开启批量添加后，输入多个标签的分隔符，支持传入多个符号，默认为"-"
 */
class InputTag extends FormItem
{
    public string $type = 'input-tag';
}
