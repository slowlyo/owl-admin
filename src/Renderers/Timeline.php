<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Timeline 时间轴</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/timeline
 *
 * @method self items($value) 配置节点数据
 * @method self source($value) 数据源，可通过数据映射获取当前数据域变量、或者配置 API 对象
 * @method self mode($value) 指定文字相对于时间轴的位置，仅 direction = vertical时支持
 * @method self direction($value) 时间轴方向
 * @method self reverse($value = true) 根据时间倒序显示
 */
class Timeline extends BaseRenderer
{
    public string $type = 'timeline';
}
