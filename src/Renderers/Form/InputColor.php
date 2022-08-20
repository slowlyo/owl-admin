<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputColor 颜色选择器</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-city
 *
 * @method self format($value) 请选择 hex、hls、rgb或者rgba。
 * @method self presetColors($value) 选择器预设颜色值 选择器底部的默认颜色，数组内为空则不显示默认颜色
 * @method self allowCustomColor($value) 为false时只能选择颜色，使用 presetColors 设定颜色选择范围
 * @method self clearable($value) 是否显示清除按钮
 * @method self resetValue($value) 清除后，表单项值调整成该值
 */
class InputColor extends FormItem
{
    public string $type = 'input-color';
}
