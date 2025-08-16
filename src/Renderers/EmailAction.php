<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * EmailAction
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class EmailAction extends BaseRenderer
{
    public function __construct()
    {
        $this->set('actionType', 'email');


    }

    /**
     * 
     */
    public function actionType($value = 'email')
    {
        return $this->set('actionType', $value);
    }

    /**
     * 
     */
    public function activeClassName($value = '')
    {
        return $this->set('activeClassName', $value);
    }

    /**
     * 
     */
    public function activeLevel($value = '')
    {
        return $this->set('activeLevel', $value);
    }

    /**
     * 
     */
    public function badge($value = '')
    {
        return $this->set('badge', $value);
    }

    /**
     * 
     */
    public function bcc($value = '')
    {
        return $this->set('bcc', $value);
    }

    /**
     * 
     */
    public function block($value = '')
    {
        return $this->set('block', $value);
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
    public function cc($value = '')
    {
        return $this->set('cc', $value);
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
    public function close($value = '')
    {
        return $this->set('close', $value);
    }

    /**
     * 
     */
    public function confirmText($value = '')
    {
        return $this->set('confirmText', $value);
    }

    /**
     * 确认弹窗标题
     */
    public function confirmTitle($value = '')
    {
        return $this->set('confirmTitle', $value);
    }

    /**
     * 
     */
    public function countDown($value = '')
    {
        return $this->set('countDown', $value);
    }

    /**
     * 
     */
    public function countDownTpl($value = '')
    {
        return $this->set('countDownTpl', $value);
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
    public function disabledOnAction($value = '')
    {
        return $this->set('disabledOnAction', $value);
    }

    /**
     * 
     */
    public function disabledTip($value = '')
    {
        return $this->set('disabledTip', $value);
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
    public function hotKey($value = '')
    {
        return $this->set('hotKey', $value);
    }

    /**
     * 
     */
    public function href($value = '')
    {
        return $this->set('href', $value);
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
    public function iconClassName($value = '')
    {
        return $this->set('iconClassName', $value);
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
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 
     */
    public function level($value = '')
    {
        return $this->set('level', $value);
    }

    /**
     * 
     */
    public function loadingClassName($value = '')
    {
        return $this->set('loadingClassName', $value);
    }

    /**
     * 
     */
    public function loadingOn($value = '')
    {
        return $this->set('loadingOn', $value);
    }

    /**
     * 
     */
    public function mergeData($value = '')
    {
        return $this->set('mergeData', $value);
    }

    /**
     * 
     */
    public function onClick($value = '')
    {
        return $this->set('onClick', $value);
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
    public function primary($value = '')
    {
        return $this->set('primary', $value);
    }

    /**
     * 
     */
    public function requireSelected($value = '')
    {
        return $this->set('requireSelected', $value);
    }

    /**
     * 
     */
    public function required($value = '')
    {
        return $this->set('required', $value);
    }

    /**
     * 
     */
    public function rightIcon($value = '')
    {
        return $this->set('rightIcon', $value);
    }

    /**
     * 
     */
    public function rightIconClassName($value = '')
    {
        return $this->set('rightIconClassName', $value);
    }

    /**
     * 
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
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
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 
     */
    public function subject($value = '')
    {
        return $this->set('subject', $value);
    }

    /**
     * 
     */
    public function tabIndex($value = '')
    {
        return $this->set('tabIndex', $value);
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
    public function to($value = '')
    {
        return $this->set('to', $value);
    }

    /**
     * 
     */
    public function tooltip($value = '')
    {
        return $this->set('tooltip', $value);
    }

    /**
     * 
     */
    public function tooltipPlacement($value = '')
    {
        return $this->set('tooltipPlacement', $value);
    }

    /**
     *  可选值: action | button | submit | reset
     */
    public function type($value = '')
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
