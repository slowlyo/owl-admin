<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * CollapseGroup 折叠渲染器，格式说明。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/collapse
 *
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticSchema($value) 
 * @method self accordion($value) 手风琴模式
 * @method self expandIcon($value) 自定义切换图标
 * @method self expandIconPosition($value) 设置图标位置 可选值: left | right | 
 * @method self hidden($value) 是否隐藏
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self type($value) 指定为折叠器类型
 * @method self activeKey($value) 激活面板
 * @method self body($value) 内容区域
 * @method self static($value) 是否静态展示
 * @method self disabled($value) 是否禁用
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visible($value) 是否显示
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self onEvent($value) 事件动作配置
 * @method self className($value) 容器 css 类名
 */
class CollapseGroup extends BaseRenderer
{
    public string $type = 'collapse-group';
}
