<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Color 颜色</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/color
 *
 * @method self className($value) 外层 CSS 类名
 * @method self value($value) 显示的颜色值
 * @method self name($value) 在其他组件中，时，用作变量映射
 * @method self defaultColor($value) 默认颜色值
 * @method self showValue($value) 是否显示右边的颜色值
 */
class Color extends BaseRenderer
{
    public string $type = 'color';
}
