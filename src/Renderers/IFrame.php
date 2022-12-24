<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * IFrame 渲染器 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/iframe
 *
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self height($value) 
 * @method self allow($value) 
 * @method self name($value) 
 * @method self referrerpolicy($value)  可选值: no-referrer | no-referrer-when-downgrade | origin | origin-when-cross-origin | same-origin | strict-origin | strict-origin-when-cross-origin | unsafe-url | 
 * @method self disabled($value) 是否禁用
 * @method self onEvent($value) 事件动作配置
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticSchema($value) 
 * @method self type($value) 
 * @method self src($value) 页面地址
 * @method self width($value) 
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visible($value) 是否显示
 * @method self static($value) 是否静态展示
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self sandbox($value) 
 * @method self className($value) 容器 css 类名
 * @method self hidden($value) 是否隐藏
 * @method self visibleOn($value) 是否显示表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self events($value) 事件相应，配置后当 iframe 通过 postMessage 发送事件时，可以触发 AMIS 内部的动作。
 * @method self disabledOn($value) 是否禁用表达式
 */
class IFrame extends BaseRenderer
{
    public string $type = 'iframe';
}
