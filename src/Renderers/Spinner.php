<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Spinner 加载中</b><br/>
 * 一般用来做 loading 使用。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/spinner
 *
 * @method self show($value) 是否显示 spinner 组件
 * @method self className($value) 图标父级标签的自定义 class
 * @method self spinnerClassName($value) 组件中 icon 所在标签的自定义 class
 * @method self spinnerWrapClassName($value) 作为容器使用时组件最外层标签的自定义 class
 * @method self size($value) 组件大小 sm lg
 * @method self icon($value) 组件图标，可以是amis内置图标，也可以是字体图标或者网络图片链接，作为 ui 库使用时也可以是自定义组件
 * @method self tip($value) 配置组件文案，例如加载中...
 * @method self tipPlacement($value) 配置组件 tip 相对于 icon 的位置
 * @method self delay($value) 配置组件显示延迟的时间（毫秒）
 * @method self overlay($value) 配置组件显示 spinner 时是否显示遮罩层
 * @method self body($value) 作为容器使用时，被包裹的内容
 */
class Spinner extends BaseRenderer
{
    public string $type = 'spinner';
}
