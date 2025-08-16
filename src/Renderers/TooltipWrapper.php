<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * TooltipWrapper
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class TooltipWrapper extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'tooltip-wrapper');


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
    public function content($value = '')
    {
        return $this->set('content', $value);
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
    public function enterable($value = true)
    {
        return $this->set('enterable', $value);
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
    public function inline($value = '')
    {
        return $this->set('inline', $value);
    }

    /**
     * 
     */
    public function mouseEnterDelay($value = '')
    {
        return $this->set('mouseEnterDelay', $value);
    }

    /**
     * 
     */
    public function mouseLeaveDelay($value = '')
    {
        return $this->set('mouseLeaveDelay', $value);
    }

    /**
     * 
     */
    public function offset($value = '')
    {
        return $this->set('offset', $value);
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
    public function placement($value = '')
    {
        return $this->set('placement', $value);
    }

    /**
     * 
     */
    public function rootClose($value = '')
    {
        return $this->set('rootClose', $value);
    }

    /**
     * 
     */
    public function showArrow($value = '')
    {
        return $this->set('showArrow', $value);
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
    public function tooltip($value = '')
    {
        return $this->set('tooltip', $value);
    }

    /**
     * 
     */
    public function tooltipArrowClassName($value = '')
    {
        return $this->set('tooltipArrowClassName', $value);
    }

    /**
     * 
     */
    public function tooltipClassName($value = '')
    {
        return $this->set('tooltipClassName', $value);
    }

    /**
     * 
     */
    public function tooltipStyle($value = '')
    {
        return $this->set('tooltipStyle', $value);
    }

    /**
     * 
     */
    public function tooltipTheme($value = '')
    {
        return $this->set('tooltipTheme', $value);
    }

    /**
     * 
     */
    public function trigger($value = '')
    {
        return $this->set('trigger', $value);
    }

    /**
     * 
     */
    public function type($value = 'tooltip-wrapper')
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
    public function wrapperComponent($value = '')
    {
        return $this->set('wrapperComponent', $value);
    }


}
