<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * <b>Custom 自定义组件</b><br/>
 * 用于实现自定义组件，它解决了之前 JS SDK 和可视化编辑器中难以支持自定义组件的问题。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/custom
 *
 * @method self id($value) 节点 id
 * @method self name($value) 节点 名称
 * @method self className($value) 节点 class
 * @method self inline($value) 默认使用 div 标签，如果 true 就使用 span 标签
 * @method self html($value) 初始化节点 html
 * @method self onMount($value) 节点初始化之后调的用函数
 * @method self onUpdate($value) 数据有更新的时候调用的函数
 * @method self onUnmount($value) 节点销毁的时候调用的函数
 */
class Custom extends BaseRenderer
{
    public string $type = 'custom';
}
