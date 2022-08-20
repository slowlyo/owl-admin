<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Image 图片</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/image
 *
 * @method self className($value) 外层 CSS 类名
 * @method self imageClassName($value) 图片 CSS 类名
 * @method self thumbClassName($value) 图片缩率图 CSS 类名
 * @method self height($value) 图片缩率高度
 * @method self width($value) 图片缩率宽度
 * @method self title($value) 标题
 * @method self imageCaption($value) 描述
 * @method self placeholder($value) 占位文本
 * @method self defaultImage($value) 无数据时显示的图片
 * @method self src($value) 缩略图地址
 * @method self href($value) 外部链接地址
 * @method self originalSrc($value) 原图地址
 * @method self enlargeAble($value) 支持放大预览
 * @method self enlargeTitle($value) 放大预览的标题
 * @method self enlargeCaption($value) 放大预览的描述
 * @method self thumbMode($value) 预览图模式，可选：'w-full', 'h-full', 'contain', 'cover'
 * @method self thumbRatio($value) 预览图比例，可选：'1:1', '4:3', '16:9'
 * @method self imageMode($value) 图片展示模式，可选：'thumb', 'original' 即：缩略图模式 或者 原图模式
 */
class Image extends BaseRenderer
{
    public string $type = 'image';
}
