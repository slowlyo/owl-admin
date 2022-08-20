<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Sparkline 走势图</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/sparkline
 *
 * @method self name($value) 关联的变量
 * @method self width($value) 宽度
 * @method self height($value) 高度
 * @method self placeholder($value) 数据为空时显示的内容
 */
class Sparkline extends BaseRenderer
{
    public string $type = 'sparkline';
}
