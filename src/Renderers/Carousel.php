<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Carousel 轮播图</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/carousel
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self options($value) 轮播面板数据
 * @method self itemSchema($value) 自定义schema来展示数据
 * @method self auto($value = true) 是否自动轮播
 * @method self interval($value) 切换动画间隔
 * @method self duration($value) 切换动画时长
 * @method self width($value) 宽度
 * @method self height($value) 高度
 * @method self controls($value) 显示左右箭头、底部圆点索引
 * @method self controlsTheme($value) 左右箭头、底部圆点索引颜色，默认light，另有dark模式
 * @method self animation($value) 切换动画效果，默认fade，另有slide模式
 * @method self thumbMode($value) 图片默认缩放模式
 */
class Carousel extends BaseRenderer
{
    public string $type = 'carousel';
}
