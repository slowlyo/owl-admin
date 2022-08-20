<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>HBox 布局</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/hbox
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self gap($value) 水平间距
 * @method self valign($value) 垂直对齐方式
 * @method self align($value) 水平对齐方式
 * @method self columns($value) 列集合
 */
class HBox extends BaseRenderer
{
    public string $type = 'hbox';
}
