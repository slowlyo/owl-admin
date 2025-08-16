<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * WizardStep
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class WizardStep extends BaseRenderer
{
    public function __construct()
    {
        

    }

    /**
     * 
     */
    public function actions($value = '')
    {
        return $this->set('actions', $value);
    }

    /**
     * 
     */
    public function affixFooter($value = '')
    {
        return $this->set('affixFooter', $value);
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
    public function asyncApi($value = '')
    {
        return $this->set('asyncApi', $value);
    }

    /**
     * 
     */
    public function autoFocus($value = '')
    {
        return $this->set('autoFocus', $value);
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
    public function checkInterval($value = '')
    {
        return $this->set('checkInterval', $value);
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
    public function clearAfterSubmit($value = '')
    {
        return $this->set('clearAfterSubmit', $value);
    }

    /**
     * 
     */
    public function clearPersistDataAfterSubmit($value = '')
    {
        return $this->set('clearPersistDataAfterSubmit', $value);
    }

    /**
     * 
     */
    public function columnCount($value = '')
    {
        return $this->set('columnCount', $value);
    }

    /**
     * 
     */
    public function data($value = '')
    {
        return $this->set('data', $value);
    }

    /**
     * 
     */
    public function debug($value = '')
    {
        return $this->set('debug', $value);
    }

    /**
     * 
     */
    public function debugConfig($value = '')
    {
        return $this->set('debugConfig', $value);
    }

    /**
     * 
     */
    public function description($value = '')
    {
        return $this->set('description', $value);
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
    public function feedback($value = '')
    {
        return $this->set('feedback', $value);
    }

    /**
     * 
     */
    public function fieldSet($value = '')
    {
        return $this->set('fieldSet', $value);
    }

    /**
     * 
     */
    public function finishedField($value = '')
    {
        return $this->set('finishedField', $value);
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
    public function horizontal($value = '')
    {
        return $this->set('horizontal', $value);
    }

    /**
     * 
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
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
    public function initApi($value = '')
    {
        return $this->set('initApi', $value);
    }

    /**
     * 
     */
    public function initAsyncApi($value = '')
    {
        return $this->set('initAsyncApi', $value);
    }

    /**
     * 
     */
    public function initCheckInterval($value = '')
    {
        return $this->set('initCheckInterval', $value);
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
    public function initFinishedField($value = '')
    {
        return $this->set('initFinishedField', $value);
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
    public function jumpable($value = true)
    {
        return $this->set('jumpable', $value);
    }

    /**
     * 
     */
    public function jumpableOn($value = '')
    {
        return $this->set('jumpableOn', $value);
    }

    /**
     * 
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 
     */
    public function labelAlign($value = '')
    {
        return $this->set('labelAlign', $value);
    }

    /**
     * 
     */
    public function labelWidth($value = '')
    {
        return $this->set('labelWidth', $value);
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
    public function mode($value = '')
    {
        return $this->set('mode', $value);
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
    public function panelClassName($value = '')
    {
        return $this->set('panelClassName', $value);
    }

    /**
     * 
     */
    public function persistData($value = '')
    {
        return $this->set('persistData', $value);
    }

    /**
     * 
     */
    public function persistDataKeys($value = '')
    {
        return $this->set('persistDataKeys', $value);
    }

    /**
     * 
     */
    public function preventEnterSubmit($value = '')
    {
        return $this->set('preventEnterSubmit', $value);
    }

    /**
     * 
     */
    public function primaryField($value = '')
    {
        return $this->set('primaryField', $value);
    }

    /**
     * 
     */
    public function promptPageLeave($value = '')
    {
        return $this->set('promptPageLeave', $value);
    }

    /**
     * 
     */
    public function promptPageLeaveMessage($value = '')
    {
        return $this->set('promptPageLeaveMessage', $value);
    }

    /**
     * 
     */
    public function redirect($value = '')
    {
        return $this->set('redirect', $value);
    }

    /**
     * 
     */
    public function reload($value = '')
    {
        return $this->set('reload', $value);
    }

    /**
     * 
     */
    public function resetAfterSubmit($value = '')
    {
        return $this->set('resetAfterSubmit', $value);
    }

    /**
     * 
     */
    public function rules($value = '')
    {
        return $this->set('rules', $value);
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
    public function subTitle($value = '')
    {
        return $this->set('subTitle', $value);
    }

    /**
     * 
     */
    public function submitOnChange($value = '')
    {
        return $this->set('submitOnChange', $value);
    }

    /**
     * 
     */
    public function submitOnInit($value = '')
    {
        return $this->set('submitOnInit', $value);
    }

    /**
     * 
     */
    public function submitText($value = '')
    {
        return $this->set('submitText', $value);
    }

    /**
     * 
     */
    public function tabs($value = '')
    {
        return $this->set('tabs', $value);
    }

    /**
     * 
     */
    public function target($value = '')
    {
        return $this->set('target', $value);
    }

    /**
     * 
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
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
    public function value($value = '')
    {
        return $this->set('value', $value);
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
    public function wrapWithPanel($value = '')
    {
        return $this->set('wrapWithPanel', $value);
    }


}
