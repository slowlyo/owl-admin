<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>Chained-Select 链式下拉框</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/chain-select
 *
 * @method self options($value) 选项组
 * @method self source($value) 动态选项组
 * @method self autoComplete($value) 自动选中
 * @method self delimiter($value) 拼接符
 * @method self labelField($value) 选项标签字段
 * @method self valueField($value) 选项值字段
 * @method self joinValues($value = true) 拼接值
 * @method self extractValue($value = true) 提取值
 */
class ChainedSelect extends FormItem
{
    public string $type = 'chained-select';
}
