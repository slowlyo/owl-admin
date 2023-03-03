<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * <b>InputYearRange 年份范围</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-year-range
 *
 * @method self format($value) 年份选择器值格式
 * @method self inputFormat($value) 年份选择器显示格式
 * @method self placeholder($value) 占位文本
 * @method self minDate($value) 限制最小日期，用法同 限制范围
 * @method self maxDate($value) 限制最大日期，用法同 限制范围
 * @method self minDuration($value) 限制最小跨度，如： 2year
 * @method self maxDuration($value) 限制最大跨度，如：4year
 * @method self utc($value) 保存 UTC 值
 * @method self clearable($value) 是否可清除
 * @method self embed($value) 是否内联模式
 */
class InputYearRange extends FormItem
{
    public string $type = 'input-year-range';
}
