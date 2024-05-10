<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * ChartRadios 图表单选框
 *
 * @author  slowlyo
 * @version 6.4.1
 */
class ChartRadios extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'chart-radios');
    }

    /**
     * 图表数值字段名
     */
    public function chartValueField($value = '')
    {
        return $this->set('chartValueField', $value);
    }

    /**
     * 图表配置
     */
    public function config($value = '')
    {
        return $this->set('config', $value);
    }

    /**
     * 高亮的时候是否显示 tooltip
     */
    public function showTooltipOnHighlight($value = true)
    {
        return $this->set('showTooltipOnHighlight', $value);
    }

    /**
     * 指定为 chart-radios 渲染器。
     */
    public function type($value = 'chart-radios')
    {
        return $this->set('type', $value);
    }


}
