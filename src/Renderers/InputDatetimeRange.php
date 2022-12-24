<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>InputDatetimeRange 日期时间范围</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-datetime-range
 *
 * @method self format($value) 日期时间选择器值格式
 * @method self inputFormat($value) 日期时间选择器显示格式
 * @method self placeholder($value) 占位文本
 * @method self ranges($value) 日期范围快捷键
 * @method self minDate($value) 限制最小日期时间，用法同 限制范围
 * @method self maxDate($value) 限制最大日期时间，用法同 限制范围
 * @method self utc($value) 保存 UTC 值
 * @method self clearable($value) 是否可清除
 */
class InputDatetimeRange extends FormItem
{
    public string $type = 'input-datetime-range';
}
