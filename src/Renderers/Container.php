<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Container 容器</b><br/>
 * Container 是一种容器组件，它可以渲染其他 amis 组件。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/container
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self bodyClassName($value) 容器内容区的类名
 * @method self wrapperComponent($value) "div" 容器标签名
 * @method self style($value) 自定义样式
 * @method self body($value) 容器内容
 */
class Container extends BaseRenderer
{
    public string $type = 'container';
}
