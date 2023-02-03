<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self overflowIndicator($value) 菜单触发按钮的图标
 * @method self overflowPopoverClassName($value) Popover浮层CSS类名
 * @method self maxVisibleCount($value) 导航横向布局时，开启开启响应式收纳后最大可显示数量，超出此数量的导航将被收纳到下拉菜单中
 * @method self style($value) 自定义样式
 * @method self popOverContainer($value) 菜单DOM挂载点
 * @method self overflowSuffix($value) 导航列表后缀节点
 * @method self enable($value) 是否开启响应式收纳
 * @method self overflowLabel($value) 菜单触发按钮的文字
 * @method self overflowClassName($value) 菜单触发按钮CSS类名
 * @method self overflowListClassName($value) 菜单外层CSS类名
 * @method self wrapperComponent($value) 包裹导航的外层标签名，可以使用其他标签渲染
 * @method self itemWidth($value) 导航项目宽度
 */
class NavOverflow extends BaseRenderer
{
}
