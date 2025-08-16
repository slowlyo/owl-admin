<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Service 服务类控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/service
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Service extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'service');


    }

    /**
     * 
     */
    public function api($value = '')
    {
        return $this->set('api', $value);
    }

    /**
     * 
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
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
    public function dataProvider($value = '')
    {
        return $this->set('dataProvider', $value);
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
    public function fetchOn($value = '')
    {
        return $this->set('fetchOn', $value);
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
    public function initFetch($value = '')
    {
        return $this->set('initFetch', $value);
    }

    /**
     * 
     */
    public function initFetchOn($value = '')
    {
        return $this->set('initFetchOn', $value);
    }

    /**
     * 
     */
    public function initFetchSchema($value = '')
    {
        return $this->set('initFetchSchema', $value);
    }

    /**
     * 
     */
    public function initFetchSchemaOn($value = '')
    {
        return $this->set('initFetchSchemaOn', $value);
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
    public function loadingConfig($value = '')
    {
        return $this->set('loadingConfig', $value);
    }

    /**
     * 
     */
    public function messages($value = '')
    {
        return $this->set('messages', $value);
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
    public function schemaApi($value = '')
    {
        return $this->set('schemaApi', $value);
    }

    /**
     * 
     */
    public function showErrorMsg($value = '')
    {
        return $this->set('showErrorMsg', $value);
    }

    /**
     * 
     */
    public function silentPolling($value = '')
    {
        return $this->set('silentPolling', $value);
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
    public function stopAutoRefreshWhen($value = '')
    {
        return $this->set('stopAutoRefreshWhen', $value);
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
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 
     */
    public function type($value = 'service')
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

    /**
     * 
     */
    public function ws($value = '')
    {
        return $this->set('ws', $value);
    }


}
