<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * <b>GridNav 宫格导航</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/grid-nav
 *
 * @method self className($value) 外层 CSS 类名
 * @method self itemClassName($value) 列表项 css 类名
 * @method self value($value) 图片数组
 * @method self source($value) 数据源
 * @method self square($value) 是否将列表项固定为正方形
 * @method self center($value) 是否将列表项内容居中显示
 * @method self border($value) 是否显示列表项边框
 * @method self gutter($value) 列表项之间的间距，默认单位为px
 * @method self reverse($value) 是否调换图标和文本的位置
 * @method self iconRatio($value) 图标宽度占比，单位%
 * @method self direction($value) 列表项内容排列的方向，可选值为 horizontal 、vertical
 * @method self columnNum($value) 列数
 * @method self options($value) 列表项图标
 */
class GridNav extends BaseRenderer
{
    public string $type = 'grid-nav';
}
