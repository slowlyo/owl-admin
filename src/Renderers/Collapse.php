<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Collapse 折叠渲染器，格式说明。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/collapse
 *
 * @method self key($value) 标识
 * @method self mountOnEnter($value) 点开时才加载内容
 * @method self unmountOnExit($value) 卡片隐藏就销毁内容。
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self headerPosition($value) 标题展示位置 可选值: top | bottom | 
 * @method self bodyClassName($value) 配置 Body 容器 className
 * @method self collapsed($value) 默认是否折叠
 * @method self onEvent($value) 事件动作配置
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self body($value) 内容区域
 * @method self collapseHeader($value) 收起的标题
 * @method self size($value) 控件大小 可选值: xs | sm | md | lg | base | 
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self static($value) 是否静态展示
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self type($value) 指定为折叠器类型
 * @method self header($value) 标题
 * @method self expandIcon($value) 自定义切换图标
 * @method self visible($value) 是否显示
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self collapsable($value) 是否可折叠
 * @method self className($value) 容器 css 类名
 * @method self headingClassName($value) 标题 CSS 类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self disabled($value) 是否禁用
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticSchema($value) 
 * @method self showArrow($value) 图标是否展示
 * @method self hidden($value) 是否隐藏
 */
class Collapse extends BaseRenderer
{
    public string $type = 'collapse';
}
