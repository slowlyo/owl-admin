<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>BarCode 条形码</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/barcode
 *
 * @method self className($value) 外层 CSS 类名
 * @method self value($value) 显示的颜色值
 * @method self name($value) 在其他组件中，时，用作变量映射
 */
class BarCode extends BaseRenderer
{
    public string $type = 'barcode';
}
