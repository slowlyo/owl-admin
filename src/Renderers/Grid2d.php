<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Grid 2D 布局</b><br/>
 * Grid 2D 是一种二维布局方式，它可以更直观设置组件位置。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/grid-2d
 *
 * @method self gridClassName($value) 外层 Dom 的类名
 * @method self gap($value) 格子间距，包括水平和垂直
 * @method self cols($value) 格子水平划分为几个区域
 * @method self rowHeight($value) 每个格子默认垂直高度
 * @method self rowGap($value) 格子垂直间距
 * @method self grids($value) 格子集合
 */
class Grid2d extends BaseRenderer
{
    public string $type = 'grid-2d';
}
