<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Icon 图标</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/icon
 *
 * @method self className($value) 外层 CSS 类名
 * @method self icon($value) icon 名称，支持 fontawesome v4 或 通过 registerIcon 注册的 icon、或使用 url
 * @method self vendor($value) icon 类型，默认为fa, 表示 fontawesome v4。也支持 iconfont, 如果是 fontawesome v5 以上版本或者其他框架可以设置为空字符串
 */
class Icon extends BaseRenderer
{
    public string $type = 'icon';
}
