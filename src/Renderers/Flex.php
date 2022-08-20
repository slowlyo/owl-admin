<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Flex 布局</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/flex
 *
 * @method self className($value) css 类名
 * @method self justify($value) "start", "flex-start", "center", "end", "flex-end", "space-around", "space-between", "space-evenly"
 * @method self alignItems($value) "stretch", "start", "flex-start", "flex-end", "end", "center", "baseline"
 * @method self style($value) 自定义样式
 * @method self direction($value) 布局方向: column, row
 * @method self items($value) 子元素, 数组表示多个
 */
class Flex extends BaseRenderer
{
    public string $type = 'flex';
}
