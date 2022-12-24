<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * 选项卡控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/tabs
 *
 * @method self onEvent($value) 事件动作配置
 * @method self staticSchema($value) 
 * @method self showTip($value) 是否显示提示
 * @method self sidePosition($value) 编辑器模式，侧边的位置 可选值: left | right | 
 * @method self activeKey($value) 默认激活的选项卡，hash值或索引值，支持使用表达式
 * @method self draggable($value) 是否支持拖拽
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self type($value) 
 * @method self mountOnEnter($value) 卡片是否只有在点开的时候加载？
 * @method self unmountOnExit($value) 卡片隐藏的时候是否销毁卡片内容
 * @method self subFormMode($value) 配置子表单项默认的展示方式。 可选值: normal | inline | horizontal | 
 * @method self disabled($value) 是否禁用
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visibleOn($value) 是否显示表达式
 * @method self source($value) 关联已有数据，选项卡直接根据目标数据重复。
 * @method self linksClassName($value) 链接外层类名
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self subFormHorizontal($value) 如果是水平排版，这个属性可以细化水平排版的左右宽度占比。
 * @method self closable($value) 是否支持删除
 * @method self collapseBtnLabel($value) 折叠按钮文字
 * @method self static($value) 是否静态展示
 * @method self tabsClassName($value) 类名
 * @method self toolbar($value) 可以在右侧配置点其他功能按钮。
 * @method self showTipClassName($value) tooltip 提示的类名
 * @method self editable($value) 是否可编辑标签名
 * @method self scrollable($value) 是否导航支持内容溢出滚动。属性废弃，为了兼容暂且保留
 * @method self collapseOnExceed($value) 超过多少个时折叠按钮
 * @method self className($value) 容器 css 类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hidden($value) 是否隐藏
 * @method self visible($value) 是否显示
 * @method self tabsMode($value) 展示形式
 * @method self addable($value) 是否支持新增
 * @method self addBtnText($value) 自定义增加按钮文案
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self tabs($value) 选项卡成员。当配置了 source 时，选项卡成员，将会根据目标数据进行重复。
 * @method self contentClassName($value) 内容类名
 */
class Tabs extends BaseRenderer
{
    public string $type = 'tabs';
}
