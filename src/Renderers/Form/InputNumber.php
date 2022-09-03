<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputNumber 数字输入框</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-number
 *
 * @method self min($value) 最小值
 * @method self max($value) 最大值
 * @method self step($value) 步长
 * @method self precision($value) 精度，即小数点后几位
 * @method self showSteps($value) 是否显示上下点击按钮
 * @method self prefix($value) 前缀
 * @method self suffix($value) 后缀
 * @method self kilobitSeparator($value) 千分分隔
 * @method self keyboard($value) 键盘事件（方向上下）
 * @method self displayMode($value) 样式类型
 */
class InputNumber extends FormItem
{
    public string $type = 'input-number';
}
