<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>ButtonGroup 按钮组</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/button-group
 *
 * @method self vertical($value) 是否使用垂直模式
 * @method self tiled($value) 是否使用平铺模式
 * @method self btnLevel($value) 按钮样式
 * @method self btnActiveLevel($value) 选中按钮样式
 * @method self buttons($value) 按钮
 * @method self className($value) 外层 Dom 的类名
 */
class ButtonGroup extends BaseRenderer
{
    public string $type = 'button-group';
}
