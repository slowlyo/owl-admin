<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Wrapper 包裹容器</b><br/>
 * 简单的一个包裹容器组件，相当于用 div 包含起来，最大的用处是用来配合 css 进行布局。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/wrapper
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self size($value) 支持: xs、sm、md和lg
 * @method self style($value) 自定义样式
 * @method self body($value) 内容容器
 */
class Wrapper extends BaseRenderer
{
    public string $type = 'wrapper';
}
