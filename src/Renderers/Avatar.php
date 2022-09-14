<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Avatar 头像</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/avaatar
 *
 * @method self className($value) 外层 dom 的类名
 * @method self style($value) 外层 dom 的样式
 * @method self fit($value) 具体细节可以参考 MDN 文档
 * @method self src($value) 图片地址
 * @method self text($value) 文字
 * @method self icon($value) 图标
 * @method self shape($value) 形状，有三种 'circle' （圆形）、'square'（正方形）、'rounded'（圆角）
 * @method self size($value)
 * @method self gap($value) 控制字符类型距离左右两侧边界单位像素
 * @method self alt($value) 图像无法显示时的替代文本
 * @method self draggable($value) 图片是否允许拖动
 * @method self crossOrigin($value) 图片的 CORS 属性设置
 * @method self onError($value) 图片加载失败的字符串，这个字符串是一个New Function内部执行的字符串，参数是event（使用event.nativeEvent获取原生dom事件），这个字符串需要返回boolean值。设置 "return ture;" 会在图片加载失败后，使用 text 或者 icon 代表的信息来进行替换。目前图片加载失败默认是不进行置换。注意：图片加载失败，不包括$获取数据为空情况
 */
class Avatar extends BaseRenderer
{
    public string $type = 'avatar';
}
