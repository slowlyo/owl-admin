<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>Textarea 多行文本输入框</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/textarea
 *
 * @method self minRows($value) 最小行数
 * @method self maxRows($value) 最大行数
 * @method self trimContents($value) 是否去除首尾空白文本
 * @method self readOnly($value) 是否只读
 * @method self showCounter($value) 是否显示计数器
 * @method self maxLength($value) 限制最大字数
 * @method self clearable($value) 是否可清除
 * @method self resetValue($value) 清除后设置此配置项给定的值。
 */
class Textarea extends FormItem
{
    public string $type = 'textarea';
}
