<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * <b>ChartRadios 图表单选框</b><br/>
 * 图表点选功能，用来做多个图表联动。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/chart-radios
 *
 * @method self config($value) 图表配置
 * @method self showTooltipOnHighlight($value) 高亮的时候是否显示 tooltip
 * @method self chartValueField($value) 图表数值字段名
 */
class ChartRadios extends FormItem
{
    public string $type = 'chart-radios';
}
