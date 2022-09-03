<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Images 图片集</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/images
 *
 * @method self className($value) 外层 CSS 类名
 * @method self defaultImage($value) 默认展示图片
 * @method self value($value) 图片数组
 * @method self source($value) 数据源
 * @method self delimiter($value) 分隔符，当 value 为字符串时，用该值进行分隔拆分
 * @method self src($value) 预览图地址，支持数据映射获取对象中图片变量
 * @method self originalSrc($value) 原图地址，支持数据映射获取对象中图片变量
 * @method self enlargeAble($value = true) 支持放大预览
 * @method self thumbMode($value) 预览图模式，可选：'w-full', 'h-full', 'contain', 'cover'
 * @method self thumbRatio($value) 预览图比例，可选：'1:1', '4:3', '16:9'
 */
class Images extends BaseRenderer
{
    public string $type = 'images';
}
