<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputMonth 月份</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-month
 *
 * @method self value($value) 默认值
 * @method self format($value) 月份选择器值格式，更多格式类型请参考 moment
 * @method self inputFormat($value) 月份选择器显示格式，即时间戳格式，更多格式类型请参考 moment
 * @method self placeholder($value) 占位文本
 * @method self clearable($value) 是否可清除
 */
class InputMonth extends FormItem
{
    public string $type = 'input-month';
}
