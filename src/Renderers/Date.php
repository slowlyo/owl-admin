<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Date 日期时间</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/date
 *
 * @method self className($value) 外层 CSS 类名
 * @method self value($value) 显示的日期数值
 * @method self name($value) 在其他组件中，时，用作变量映射
 * @method self placeholder($value) 占位内容
 * @method self format($value) 展示格式, 更多格式类型请参考 文档
 * @method self valueFormat($value) 数据格式，默认为时间戳。更多格式类型请参考 文档
 * @method self fromNow($value = true) 是否显示相对当前的时间描述，比如: 11 小时前、3 天前、1 年前等，fromNow 为 true 时，format 不生效。
 * @method self updateFrequency($value) 更新频率， 默认为 1 分钟
 */
class Date extends BaseRenderer
{
    public string $type = 'date';
}
