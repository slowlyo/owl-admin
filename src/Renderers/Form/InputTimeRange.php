<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputTimeRange 时间范围</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-time-range
 *
 * @method self timeFormat($value) 时间范围选择器值格式
 * @method self format($value) 时间范围选择器值格式
 * @method self inputFormat($value) 时间范围选择器显示格式
 * @method self placeholder($value) 占位文本
 * @method self clearable($value = true) 是否可清除
 * @method self embed($value = true) 是否内联模式
 */
class InputTimeRange extends FormItem
{
    public string $type = 'input-time-range';
}
