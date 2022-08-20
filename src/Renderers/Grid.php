<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Grid 水平分栏</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/grid
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self gap($value) 水平间距
 * @method self valign($value) 垂直对齐方式
 * @method self align($value) 水平对齐方式
 * @method self columns($value)列集合
 */
class Grid extends BaseRenderer
{
    public string $type = 'grid';
}
