<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>AnchorNav 锚点导航</b><br/>
 * 锚点导航容器组件。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/anchor-nav
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self linkClassName($value) 导航 Dom 的类名
 * @method self sectionClassName($value) 锚点区域 Dom 的类名
 * @method self links($value) links 内容
 * @method self direction($value) 可以配置导航水平展示还是垂直展示。对应的配置项分别是：vertical、horizontal
 * @method self active($value) 需要定位的区域
 */
class AnchorNav extends BaseRenderer
{
    public string $type = 'anchor-nav';
}
