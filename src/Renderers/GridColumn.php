<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * @method self horizontal($value) 如果是水平排版，这个属性可以细化水平排版的左右宽度占比。
 * @method self body($value) 
 * @method self sm($value) 小屏时（>=768px）宽度占比
 * @method self lg($value) 大屏时(>=1200px)宽度占比
 * @method self valign($value) 垂直对齐方式 可选值: top | middle | bottom | between | 
 * @method self mode($value) 配置子表单项默认的展示方式。 可选值: normal | inline | horizontal | 
 * @method self xs($value) 极小屏（<768px）时宽度占比
 * @method self md($value) 中屏时(>=992px)宽度占比
 * @method self columnClassName($value) 列类名
 */
class GridColumn extends BaseRenderer
{
}
