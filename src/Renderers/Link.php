<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Link 链接</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/link
 *
 * @method self body($value) 标签内文本
 * @method self href($value) 链接地址
 * @method self blank($value) 是否在新标签页打开
 * @method self htmlTarget($value) 标签的 target，优先于 blank 属性
 * @method self title($value) 标签的 title
 * @method self disabled($value) 禁用超链接
 * @method self icon($value) 超链接图标，以加强显示
 * @method self rightIcon($value) 右侧图标
 */
class Link extends BaseRenderer
{
    public string $type = 'link';
}
