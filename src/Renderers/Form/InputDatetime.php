<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputDatetime 日期时间</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-datetime
 *
 * @method self value($value) 默认值
 * @method self format($value) 日期时间选择器值格式，更多格式类型请参考 文档
 * @method self inputFormat($value) 日期时间选择器显示格式，即时间戳格式，更多格式类型请参考 文档
 * @method self placeholder($value) 占位文本
 * @method self shortcuts($value) 日期时间快捷键
 * @method self minDate($value) 限制最小日期时间
 * @method self maxDate($value) 限制最大日期时间
 * @method self utc($value) 保存 utc 值
 * @method self clearable($value) 是否可清除
 * @method self embed($value) 是否内联
 * @method self timeConstraints($value) 请参考 input-time 里的说明
 */
class InputDatetime extends FormItem
{
    public string $type = 'input-datetime';
}
