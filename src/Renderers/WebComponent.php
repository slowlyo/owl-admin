<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Web Component</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/web-component
 *
 * @method self tag($value) 具体使用的 web-component 标签
 * @method self props($value) 标签上的属性
 * @method self body($value) 子节点
 */
class WebComponent extends BaseRenderer
{
    public string $type = 'web-component';
}
