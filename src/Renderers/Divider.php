<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 *<b>Divider 分割线</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/divider
 * @method self className($value) 外层 Dom 的类名
 * @method self lineStyle($value) 分割线的样式，支持dashed和solid
 */
class Divider extends BaseRenderer
{
    public string $type = 'divider';
}
