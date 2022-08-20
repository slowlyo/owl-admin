<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>Switch 开关</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/switch
 *
 * @method self option($value) 选项说明
 * @method self onText($value) 开启时开关显示的内容
 * @method self offText($value) 关闭时开关显示的内容
 * @method self trueValue($value) 标识真值
 * @method self falseValue($value) 标识假值
 * @method self size($value) 开关大小
 */
class InputSwitch extends FormItem
{
    public string $type = 'switch';
}
