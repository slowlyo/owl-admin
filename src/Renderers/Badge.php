<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Badge 角标。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/badge
 *
 * @method self text($value) 文本内容
 * @method self mode($value) 角标类型 可选值: text | dot | ribbon | 
 * @method self level($value) 提示类型
 * @method self animation($value) 是否显示动画
 * @method self style($value) 角标的自定义样式
 * @method self className($value) 
 * @method self size($value) 大小
 * @method self offset($value) 角标位置，相对于position的位置进行偏移
 * @method self position($value) 角标位置 可选值: top-right | top-left | bottom-right | bottom-left | 
 * @method self overflowCount($value) 封顶的数字值
 * @method self visibleOn($value) 动态控制是否显示
 */
class Badge extends BaseRenderer
{
}
