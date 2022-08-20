<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Tasks 任务操作集合</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/tasks
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self tableClassName($value) table Dom 的类名
 * @method self items($value) 任务列表
 * @method self checkApi($value) 返回任务列表，返回的数据请参考 items。
 * @method self submitApi($value) 提交任务使用的 API
 * @method self reSubmitApi($value) 如果任务失败，且可以重试，提交的时候会使用此 API
 * @method self interval($value) 当有任务进行中，会每隔一段时间再次检测，而时间间隔就是通过此项配置，默认 3s。
 * @method self taskNameLabel($value) 任务名称列说明
 * @method self operationLabel($value) 操作列说明
 * @method self statusLabel($value) 状态列说明
 * @method self remarkLabel($value) 备注列说明
 * @method self btnText($value) 操作按钮文字
 * @method self retryBtnText($value) 重试操作按钮文字
 * @method self btnClassName($value) 配置容器按钮 className
 * @method self retryBtnClassName($value) 配置容器重试按钮 className
 * @method self statusLabelMap($value) 状态显示对应的类名配置
 * @method self statusTextMap($value) 状态显示对应的文字显示配置
 */
class Tasks extends BaseRenderer
{
    public string $type = 'tasks';
}
