<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Drawer 抽出式弹框。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/drawer
 *
 * @method self hidden($value) 是否隐藏
 * @method self visible($value) 是否显示
 * @method self staticSchema($value) 
 * @method self type($value) 
 * @method self closeOnEsc($value) 是否支持按 ESC 关闭 Dialog
 * @method self width($value) 抽屉的宽度 （当position为left | right时生效）
 * @method self className($value) 配置 外层 className
 * @method self disabled($value) 是否禁用
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self position($value) 从什么位置弹出 可选值: left | right | top | bottom | 
 * @method self visibleOn($value) 是否显示表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self header($value) 头部
 * @method self footer($value) 底部
 * @method self actions($value) 默认不用填写，自动会创建确认和取消按钮。
 * @method self headerClassName($value) 配置 头部 容器 className
 * @method self showErrorMsg($value) 是否显示错误信息
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self static($value) 是否静态展示
 * @method self body($value) 内容区域
 * @method self closeOnOutside($value) 点击外部的时候是否关闭弹框。
 * @method self confirm($value) 影响自动生成的按钮，如果自己配置了按钮这个配置无效。
 * @method self resizable($value) 是否可以拖动弹窗大小
 * @method self overlay($value) 是否显示蒙层
 * @method self onEvent($value) 事件动作配置
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self name($value) 
 * @method self height($value) 抽屉的高度 （当position为top | bottom时生效）
 * @method self title($value) 请通过配置 title 设置标题
 * @method self showCloseButton($value) 是否展示关闭按钮 当值为false时，默认开启closeOnOutside
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self bodyClassName($value) 配置 Body 容器 className
 * @method self footerClassName($value) 配置 头部 容器 className
 * @method self size($value) Dialog 大小 可选值: xs | sm | md | lg | full | 
 */
class Drawer extends BaseRenderer
{
    public string $type = 'drawer';
}
