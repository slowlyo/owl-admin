<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Calendar 日历日程</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/calendar
 *
 * @method self schedules($value) 日历中展示日程，可设置静态数据或从上下文中取数据，startTime 和 endTime 格式参考文档，className 参考背景色
 * @method self scheduleClassNames($value) 日历中展示日程的颜色，参考背景色
 * @method self scheduleAction($value) 自定义日程展示
 * @method self largeMode($value) 放大模式
 */
class Calendar extends BaseRenderer
{
    public string $type = 'calendar';
}
