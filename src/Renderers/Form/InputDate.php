<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputDate 日期</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-date
 *
 * @method self value($value) 默认值
 * @method self format($value) 日期选择器值格式，更多格式类型请参考 文档
 * @method self inputFormat($value) 日期选择器显示格式，即时间戳格式，更多格式类型请参考 文档
 * @method self closeOnSelect($value) 点选日期后，是否马上关闭选择框
 * @method self placeholder($value) 占位文本
 * @method self shortcuts($value) 日期快捷键
 * @method self minDate($value) 限制最小日期
 * @method self maxDate($value) 限制最大日期
 * @method self utc($value = true) 保存 utc 值
 * @method self clearable($value = true) 是否可清除
 * @method self embed($value = true) 是否内联模式
 */
class InputDate extends FormItem
{
    public string $type = 'input-date';
}
