<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>Checkbox 勾选框</b><br/>
 * 用于实现勾选，功能和 Switch 类似，只是展现上不同。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/checkbox
 *
 * @method self option($value) 选项说明
 * @method self trueValue($value) 标识真值
 * @method self falseValue($value) 标识假值
 * @method self optionType($value) 设置 option 类型
 */
class Checkbox extends FormItem
{
    public string $type = 'checkbox';
}
