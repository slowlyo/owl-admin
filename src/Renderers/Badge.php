<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Badge 角标</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/badge
 *
 * @method self mode($value) 角标类型，可以是 dot/text/ribbon
 * @method self text($value) 角标文案，支持字符串和数字，在 mode = 'dot'下设置无效
 * @method self size($value) 角标大小
 * @method self level($value) 角标级别, 可以是 info/success/warning/danger, 设置之后角标背景颜色不同
 * @method self overflowCount($value) 设置封顶的数字值
 * @method self position($value) 角标位置， 可以是 top-right/top-left/bottom-right/bottom-left
 * @method self offset($value) 角标位置，offset 相对于 position 位置进行水平、垂直偏移
 * @method self className($value) 外层 dom 的类名
 * @method self animation($value = true) 角标是否显示动画
 * @method self style($value) 角标的自定义样式
 * @method self visibleOn($value) 控制角标的显示隐藏
 */
class Badge extends BaseRenderer
{
}
