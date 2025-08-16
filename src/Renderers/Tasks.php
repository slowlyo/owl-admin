<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Tasks 渲染器，格式说明 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/tasks
 * 
 * @author slowlyo
 * @version 6.13.0
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
     * 
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
     * 
     */
    public function checkApi($value = '')
    {
        return $this->set('checkApi', $value);
    }

    /**
     * 
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 
     */
    public function disabled($value = '')
    {
        return $this->set('disabled', $value);
    }

    /**
     * 
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     * 
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
     * 
     */
    public function hidden($value = '')
    {
        return $this->set('hidden', $value);
    }

    /**
     * 
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 
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
     * 
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
     * 
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 
     */
    public function operationLabel($value = '')
    {
        return $this->set('operationLabel', $value);
    }

    /**
     * 
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
     * 
     */
    public function remarkLabel($value = '')
    {
        return $this->set('remarkLabel', $value);
    }

    /**
     * 
     */
    public function retryBtnClassName($value = '')
    {
        return $this->set('retryBtnClassName', $value);
    }

    /**
     * 
     */
    public function retryBtnText($value = '')
    {
        return $this->set('retryBtnText', $value);
    }

    /**
     * 
     */
    public function static($value = '')
    {
        return $this->set('static', $value);
    }

    /**
     * 
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 
     */
    public function staticOn($value = '')
    {
        return $this->set('staticOn', $value);
    }

    /**
     * 
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
     * 
     */
    public function statusLabel($value = '')
    {
        return $this->set('statusLabel', $value);
    }

    /**
     * 
     */
    public function statusLabelMap($value = '')
    {
        return $this->set('statusLabelMap', $value);
    }

    /**
     * 
     */
    public function statusTextMap($value = '')
    {
        return $this->set('statusTextMap', $value);
    }

    /**
     * 
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 
     */
    public function submitApi($value = '')
    {
        return $this->set('submitApi', $value);
    }

    /**
     * 
     */
    public function tableClassName($value = '')
    {
        return $this->set('tableClassName', $value);
    }

    /**
     * 
     */
    public function taskNameLabel($value = '')
    {
        return $this->set('taskNameLabel', $value);
    }

    /**
     * 
     */
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 
     */
    public function type($value = 'tasks')
    {
        return $this->set('type', $value);
    }

    /**
     * 
     */
    public function useMobileUI($value = '')
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 
     */
    public function visible($value = '')
    {
        return $this->set('visible', $value);
    }

    /**
     * 
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
