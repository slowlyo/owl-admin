<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>TabItem</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/tabs
 *
 * @method self title($value) Tab 标题
 * @method self icon($value) Tab 的图标
 * @method self iconPosition($value) Tab 的图标位置 (left / right)
 * @method self tab($value) 内容区
 * @method self hash($value) 设置以后将跟 url 的 hash 对应
 * @method self reload($value = true) 设置以后内容每次都会重新渲染，对于 crud 的重新拉取很有用
 * @method self unmountOnExit($value = true) 每次退出都会销毁当前 tab 栏内容
 * @method self className($value) Tab 区域样式
 * @method self closable($value = true) 是否支持删除，优先级高于组件的 closable
 * @method self disabled($value = true) 是否禁用
 */
class TabItem extends BaseRenderer
{
}
