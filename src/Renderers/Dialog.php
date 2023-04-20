<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Dialog 弹框渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/dialog
 *
 * @method self confirm($value) 影响自动生成的按钮，如果自己配置了按钮这个配置无效。
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self closeOnOutside($value) 是否支持点其它区域关闭 Dialog
 * @method self width($value) Dialog 宽度
 * @method self header($value) 
 * @method self title($value) 请通过配置 title 设置标题
 * @method self headerClassName($value) 
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self size($value) Dialog 大小 可选值: xs | sm | md | lg | xl | full | 
 * @method self disabled($value) 是否禁用
 * @method self actions($value) 默认不用填写，自动会创建确认和取消按钮。
 * @method self height($value) Dialog 高度
 * @method self onEvent($value) 事件动作配置
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self bodyClassName($value) 配置 Body 容器 className
 * @method self body($value) 内容区域
 * @method self className($value) 容器 css 类名
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticSchema($value) 
 * @method self type($value) 
 * @method self visibleOn($value) 是否显示表达式
 * @method self static($value) 是否静态展示
 * @method self name($value) 
 * @method self showErrorMsg($value) 是否显示错误信息
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hidden($value) 是否隐藏
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visible($value) 是否显示
 * @method self showLoading($value) 是否显示 spinner
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self closeOnEsc($value) 是否支持按 ESC 关闭 Dialog
 * @method self footer($value) 
 * @method self showCloseButton($value) 是否显示关闭按钮
 */
class Dialog extends BaseRenderer
{
    public string $type = 'dialog';
}
