<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * <b>Property 属性表</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/property
 *
 * @method self className($value) 外层 dom 的类名
 * @method self style($value) 外层 dom 的样式
 * @method self labelStyle($value) 属性名的样式
 * @method self contentStyle($value) 属性值的样式
 * @method self column($value) 每行几列
 * @method self mode($value) 显示模式，目前只有 'table' 和 'simple'
 * @method self separator($value) 模式下属性名和值之间的分隔符
 * @method self title($value) 标题
 * @method self source($value) 数据源
 * @method self items($value)
 */
class Property extends BaseRenderer
{
    public string $type = 'property';
}
