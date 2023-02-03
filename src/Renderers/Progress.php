<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * 进度展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/progress
 *
 * @method self hidden($value) 是否隐藏
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self value($value) 进度值
 * @method self progressClassName($value) 进度条 CSS 类名
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self gapPosition($value) 仪表盘进度条缺口位置 可选值: top | bottom | left | right | 
 * @method self valueTpl($value) 内容的模板函数
 * @method self staticOn($value) 是否静态展示表达式
 * @method self mode($value) 进度条类型 可选值: line | circle | dashboard | 
 * @method self strokeWidth($value) 进度条线的宽度
 * @method self className($value) 容器 css 类名
 * @method self visibleOn($value) 是否显示表达式
 * @method self onEvent($value) 事件动作配置
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self type($value) 
 * @method self stripe($value) 是否显示背景间隔
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visible($value) 是否显示
 * @method self static($value) 是否静态展示
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self name($value) 关联字段名
 * @method self animate($value) 是否显示动画（只有在开启的时候才能看出来）
 * @method self gapDegree($value) 仪表盘进度条缺口角度，可取值 0 ~ 295
 * @method self threshold($value) 阈值
 * @method self staticSchema($value) 
 * @method self showLabel($value) 是否显示值
 * @method self placeholder($value) 占位符
 * @method self showThresholdText($value) 是否显示阈值数值
 * @method self disabled($value) 是否禁用
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self map($value) 配置不同的值段，用不同的样式提示用户
 */
class Progress extends BaseRenderer
{
    public string $mode = 'line';
    public string $type = 'progress';
}
