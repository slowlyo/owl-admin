<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 状态展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/status
 *
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self visibleOn($value) 是否显示表达式
 * @method self onEvent($value) 事件动作配置
 * @method self static($value) 是否静态展示
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self disabled($value) 是否禁用
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticSchema($value) 
 * @method self labelMap($value) 文字映射关系
 * @method self placeholder($value) 占位符
 * @method self source($value) 新版配置映射源的字段 可以兼容新版icon并且配置颜色 2.8.0 新增
 * @method self hidden($value) 是否隐藏
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self className($value) 容器 css 类名
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visible($value) 是否显示
 * @method self type($value) 指定为状态展示控件
 * @method self map($value) 状态图标映射关系
 */
class Status extends BaseRenderer
{
    public string $type = 'status';
}
