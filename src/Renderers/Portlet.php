<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self type($value) 指定为 portlet 类型
 * @method self tabs($value) 
 * @method self linksClassName($value) 链接外层类名
 * @method self style($value) 自定义样式
 * @method self visibleOn($value) 是否显示表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self source($value) 关联已有数据，选项卡直接根据目标数据重复。
 * @method self unmountOnExit($value) 卡片隐藏的时候是否销毁卡片内容
 * @method self hideHeader($value) 隐藏头部
 * @method self className($value) 容器 css 类名
 * @method self static($value) 是否静态展示
 * @method self contentClassName($value) 内容类名
 * @method self onEvent($value) 事件动作配置
 * @method self staticSchema($value) 
 * @method self visible($value) 是否显示
 * @method self disabled($value) 是否禁用
 * @method self hidden($value) 是否隐藏
 * @method self tabsMode($value) 展示形式 可选值:  | line | card | radio | vertical | tiled | 
 * @method self divider($value) header和内容是否展示分割线
 * @method self description($value) 标题右侧的描述
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self scrollable($value) 是否支持溢出滚动
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self tabsClassName($value) 类名
 * @method self mountOnEnter($value) 卡片是否只有在点开的时候加载？
 * @method self toolbar($value) 可以在右侧配置点其他功能按钮。不会随着tab切换
 * @method self hiddenOn($value) 是否隐藏表达式
 */
class Portlet extends BaseRenderer
{
    public string $type = 'portlet';
}
