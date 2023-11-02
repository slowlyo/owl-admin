<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Tasks 渲染器，格式说明 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/tasks
 *
 * @author  slowlyo
 * @version v3.5.2
 */
class Tasks extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'tasks');
    }

    /**
     *
     */
    public function btnClassName($value = '')
    {
        return $this->set('btnClassName', $value);
    }

    /**
     * 操作按钮文字
     */
    public function btnText($value = '')
    {
        return $this->set('btnText', $value);
    }

    /**
     *
     */
    public function canRetryStatusCode($value = '')
    {
        return $this->set('canRetryStatusCode', $value);
    }

    /**
     * 用来获取任务状态的 API，当没有进行时任务时不会发送。
     */
    public function checkApi($value = '')
    {
        return $this->set('checkApi', $value);
    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     *
     */
    public function errorStatusCode($value = '')
    {
        return $this->set('errorStatusCode', $value);
    }

    /**
     *
     */
    public function finishStatusCode($value = '')
    {
        return $this->set('finishStatusCode', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     *
     */
    public function initialStatusCode($value = '')
    {
        return $this->set('initialStatusCode', $value);
    }

    /**
     * 当有任务进行中，会每隔一段时间再次检测，而时间间隔就是通过此项配置，默认 3s。
     */
    public function interval($value = '')
    {
        return $this->set('interval', $value);
    }

    /**
     *
     */
    public function items($value = '')
    {
        return $this->set('items', $value);
    }

    /**
     *
     */
    public function loadingConfig($value = '')
    {
        return $this->set('loadingConfig', $value);
    }

    /**
     *
     */
    public function loadingStatusCode($value = '')
    {
        return $this->set('loadingStatusCode', $value);
    }

    /**
     *
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 操作列说明
     */
    public function operationLabel($value = '')
    {
        return $this->set('operationLabel', $value);
    }

    /**
     * 如果任务失败，且可以重试，提交的时候会使用此 API
     */
    public function reSubmitApi($value = '')
    {
        return $this->set('reSubmitApi', $value);
    }

    /**
     *
     */
    public function readyStatusCode($value = '')
    {
        return $this->set('readyStatusCode', $value);
    }

    /**
     * 备注列说明
     */
    public function remarkLabel($value = '')
    {
        return $this->set('remarkLabel', $value);
    }

    /**
     * 配置容器重试按钮 className
     */
    public function retryBtnClassName($value = '')
    {
        return $this->set('retryBtnClassName', $value);
    }

    /**
     * 重试操作按钮文字
     */
    public function retryBtnText($value = '')
    {
        return $this->set('retryBtnText', $value);
    }

    /**
     * 是否静态展示
     */
    public function static($value = true)
    {
        return $this->set('static', $value);
    }

    /**
     * 静态展示表单项类名
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 静态展示表单项Value类名
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 静态展示表单项Label类名
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 是否静态展示表达式
     */
    public function staticOn($value = '')
    {
        return $this->set('staticOn', $value);
    }

    /**
     * 静态展示空值占位
     */
    public function staticPlaceholder($value = '')
    {
        return $this->set('staticPlaceholder', $value);
    }

    /**
     *
     */
    public function staticSchema($value = '')
    {
        return $this->set('staticSchema', $value);
    }

    /**
     * 状态列说明
     */
    public function statusLabel($value = '')
    {
        return $this->set('statusLabel', $value);
    }

    /**
     * 状态显示对应的类名配置。
     */
    public function statusLabelMap($value = '')
    {
        return $this->set('statusLabelMap', $value);
    }

    /**
     * 状态显示对应的文字显示配置。
     */
    public function statusTextMap($value = '')
    {
        return $this->set('statusTextMap', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 提交任务使用的 API
     */
    public function submitApi($value = '')
    {
        return $this->set('submitApi', $value);
    }

    /**
     * 配置 table className
     */
    public function tableClassName($value = '')
    {
        return $this->set('tableClassName', $value);
    }

    /**
     * 任务名称列说明
     */
    public function taskNameLabel($value = '')
    {
        return $this->set('taskNameLabel', $value);
    }

    /**
     * 指定为任务类型
     */
    public function type($value = 'tasks')
    {
        return $this->set('type', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
