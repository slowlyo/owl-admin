<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Tasks 渲染器，格式说明 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/tasks
 *
 * @method self hidden($value) 是否隐藏
 * @method self staticSchema($value) 
 * @method self checkApi($value) 用来获取任务状态的 API，当没有进行时任务时不会发送。
 * @method self submitApi($value) 提交任务使用的 API
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self interval($value) 当有任务进行中，会每隔一段时间再次检测，而时间间隔就是通过此项配置，默认 3s。
 * @method self retryBtnClassName($value) 配置容器重试按钮 className
 * @method self statusLabel($value) 状态列说明
 * @method self readyStatusCode($value) 
 * @method self initialStatusCode($value) 
 * @method self className($value) 容器 css 类名
 * @method self disabled($value) 是否禁用
 * @method self disabledOn($value) 是否禁用表达式
 * @method self visibleOn($value) 是否显示表达式
 * @method self type($value) 指定为任务类型
 * @method self statusLabelMap($value) 状态显示对应的类名配置。
 * @method self taskNameLabel($value) 任务名称列说明
 * @method self reSubmitApi($value) 如果任务失败，且可以重试，提交的时候会使用此 API
 * @method self statusTextMap($value) 状态显示对应的文字显示配置。
 * @method self tableClassName($value) 配置 table className
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self btnText($value) 操作按钮文字
 * @method self items($value) 
 * @method self operationLabel($value) 操作列说明
 * @method self retryBtnText($value) 重试操作按钮文字
 * @method self canRetryStatusCode($value) 
 * @method self loadingConfig($value) 
 * @method self static($value) 是否静态展示
 * @method self btnClassName($value) 
 * @method self name($value) 
 * @method self remarkLabel($value) 备注列说明
 * @method self finishStatusCode($value) 
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visible($value) 是否显示
 * @method self onEvent($value) 事件动作配置
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self errorStatusCode($value) 
 * @method self loadingStatusCode($value) 
 */
class Tasks extends BaseRenderer
{
    public string $type = 'tasks';
}
