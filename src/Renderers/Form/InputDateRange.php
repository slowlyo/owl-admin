<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputDateRange 日期范围</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-date-range
 *
 * @method self format($value) 日期选择器值格式
 * @method self inputFormat($value) 日期选择器显示格式
 * @method self placeholder($value) 占位文本
 * @method self ranges($value) 日期范围快捷键
 * @method self minDate($value) 限制最小日期，用法同 限制范围
 * @method self maxDate($value) 限制最大日期，用法同 限制范围
 * @method self minDuration($value) 限制最小跨度，如： 2days
 * @method self maxDuration($value) 限制最大跨度，如：1year
 * @method self utc($value) 保存 UTC 值
 * @method self clearable($value) 是否可清除
 * @method self embed($value) 是否内联模式
 */
class InputDateRange extends FormItem
{
    public string $type = 'input-date-range';
}
