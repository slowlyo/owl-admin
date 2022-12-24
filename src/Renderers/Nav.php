<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Nav 导航渲染器 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/nav
 *
 * @method self staticOn($value) 是否静态展示表达式
 * @method self indentSize($value) 
 * @method self draggable($value) 可拖拽
 * @method self dragOnSameLevel($value) 仅允许同层级拖拽
 * @method self className($value) 容器 css 类名
 * @method self hidden($value) 是否隐藏
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticSchema($value) 
 * @method self itemBadge($value) 角标
 * @method self static($value) 是否静态展示
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self stacked($value) true 为垂直排列，false 为水平排列类似如 tabs。
 * @method self links($value) 链接地址集合
 * @method self saveOrderApi($value) 保存排序的 api
 * @method self type($value) 指定为 Nav 导航渲染器
 * @method self itemActions($value) 更多操作菜单列表
 * @method self disabled($value) 是否禁用
 * @method self disabledOn($value) 是否禁用表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self visible($value) 是否显示
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self overflow($value) 横向导航时自动收纳配置
 * @method self visibleOn($value) 是否显示表达式
 * @method self onEvent($value) 事件动作配置
 * @method self source($value) 可以通过 API 拉取。
 * @method self deferApi($value) 懒加载 api，如果不配置复用 source 接口。
 */
class Nav extends BaseRenderer
{
    public string $type = 'nav';
}
