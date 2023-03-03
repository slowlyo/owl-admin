<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * List 列表展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/card
 *
 * @method self checkOnItemClick($value) 点击列表单行时，是否选择
 * @method self hidden($value) 是否隐藏
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self footer($value) 底部区域
 * @method self listItem($value) 单条数据展示内容配置
 * @method self header($value) 顶部区域
 * @method self showHeader($value) 是否显示头部
 * @method self itemDraggableOn($value) 配置某项是否可拖拽排序，前提是要开启拖拽功能
 * @method self disabledOn($value) 是否禁用表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self visibleOn($value) 是否显示表达式
 * @method self headerClassName($value) 顶部区域类名
 * @method self source($value) 数据源: 绑定当前环境变量
 * @method self disabled($value) 是否禁用
 * @method self visible($value) 是否显示
 * @method self footerClassName($value) 底部区域类名
 * @method self className($value) 容器 css 类名
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self itemCheckableOn($value) 配置某项是否可以点选
 * @method self valueField($value) 可以用来作为值的字段
 * @method self size($value) 大小 可选值: sm | base | 
 * @method self static($value) 是否静态展示
 * @method self type($value) 指定为 List 列表展示控件。 可选值: list | static-list | 
 * @method self placeholder($value) 无数据提示
 * @method self onEvent($value) 事件动作配置
 * @method self staticOn($value) 是否静态展示表达式
 * @method self title($value) 标题
 * @method self affixHeader($value) 是否固顶
 * @method self itemAction($value) 点击列表项的行为
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticSchema($value) 
 * @method self showFooter($value) 是否显示底部
 * @method self hideCheckToggler($value) 是否隐藏勾选框
 */
class ListRenderer extends BaseRenderer
{
    public string $type = 'list';
}
