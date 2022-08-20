<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Nav 导航</b><br/>
 * 用于展示链接导航
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/nav
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self stacked($value) 设置成 false 可以以 tabs 的形式展示
 * @method self source($value) 可以通过变量或 API 接口动态创建导航
 * @method self deferApi($value) 用来延时加载选项详情的接口，可以不配置，不配置公用 source 接口。
 * @method self itemActions($value) 更多操作相关配置
 * @method self draggable($value) 是否支持拖拽排序
 * @method self dragOnSameLevel($value) 仅允许同层级内拖拽
 * @method self saveOrderApi($value) 保存排序的 api
 * @method self itemBadge($value) 角标
 * @method self links($value) 链接集合
 * @method self overflow($value) 响应式收纳配置
 */
class Nav extends BaseRenderer
{
    public string $type = 'nav';
}
