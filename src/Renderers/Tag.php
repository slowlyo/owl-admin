<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Tag 标签</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/tag
 *
 * @method self displayMode($value) 展现模式
 * @method self color($value) 颜色主题，提供默认主题，并支持自定义颜色值
 * @method self label($value) 标签内容
 * @method self icon($value) 图标    status 模式下的前置图标
 * @method self className($value) 自定义 CSS 样式类名
 * @method self style($value) 自定义样式（行内样式），优先级最高
 */
class Tag extends BaseRenderer
{
    public string $type = 'tag';
}
