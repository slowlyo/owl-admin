<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Drawer
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Drawer extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'drawer');


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
    public function body($value = '')
    {
        return $this->set('body', $value);
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
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 
     */
    public function closeOnEsc($value = '')
    {
        return $this->set('closeOnEsc', $value);
    }

    /**
     * 
     */
    public function closeOnOutside($value = '')
    {
        return $this->set('closeOnOutside', $value);
    }

    /**
     * 
     */
    public function confirm($value = '')
    {
        return $this->set('confirm', $value);
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
    public function footer($value = '')
    {
        return $this->set('footer', $value);
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
    public function header($value = '')
    {
        return $this->set('header', $value);
    }

    /**
     * 
     */
    public function headerClassName($value = '')
    {
        return $this->set('headerClassName', $value);
    }

    /**
     * 
     */
    public function height($value = '')
    {
        return $this->set('height', $value);
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
    public function inputParams($value = '')
    {
        return $this->set('inputParams', $value);
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
    public function overlay($value = '')
    {
        return $this->set('overlay', $value);
    }

    /**
     * 
     */
    public function position($value = '')
    {
        return $this->set('position', $value);
    }

    /**
     * 
     */
    public function resizable($value = true)
    {
        return $this->set('resizable', $value);
    }

    /**
     * 
     */
    public function showCloseButton($value = '')
    {
        return $this->set('showCloseButton', $value);
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
    public function testid($value = '')
    {
        return $this->set('testid', $value);
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
    public function type($value = 'drawer')
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
    public function width($value = '')
    {
        return $this->set('width', $value);
    }


}
