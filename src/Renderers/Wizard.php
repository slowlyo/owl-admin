<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 表单向导 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/wizard
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Wizard extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'wizard');


    }

    /**
     * 
     */
    public function actionClassName($value = '')
    {
        return $this->set('actionClassName', $value);
    }

    /**
     * 
     */
    public function actionFinishLabel($value = '')
    {
        return $this->set('actionFinishLabel', $value);
    }

    /**
     * 
     */
    public function actionNextLabel($value = '')
    {
        return $this->set('actionNextLabel', $value);
    }

    /**
     * 
     */
    public function actionNextSaveLabel($value = '')
    {
        return $this->set('actionNextSaveLabel', $value);
    }

    /**
     * 
     */
    public function actionPrevLabel($value = '')
    {
        return $this->set('actionPrevLabel', $value);
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
    public function bodyClassName($value = '')
    {
        return $this->set('bodyClassName', $value);
    }

    /**
     * 
     */
    public function bulkSubmit($value = '')
    {
        return $this->set('bulkSubmit', $value);
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
    public function footerClassName($value = '')
    {
        return $this->set('footerClassName', $value);
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
    public function initApi($value = '')
    {
        return $this->set('initApi', $value);
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
    public function readOnly($value = '')
    {
        return $this->set('readOnly', $value);
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
    public function startStep($value = '')
    {
        return $this->set('startStep', $value);
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
    public function stepClassName($value = '')
    {
        return $this->set('stepClassName', $value);
    }

    /**
     * 
     */
    public function steps($value = '')
    {
        return $this->set('steps', $value);
    }

    /**
     * 
     */
    public function stepsClassName($value = '')
    {
        return $this->set('stepsClassName', $value);
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
    public function target($value = '')
    {
        return $this->set('target', $value);
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
    public function type($value = 'wizard')
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
    public function wrapWithPanel($value = '')
    {
        return $this->set('wrapWithPanel', $value);
    }


}
