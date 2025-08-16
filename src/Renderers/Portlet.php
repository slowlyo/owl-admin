<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Portlet
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Portlet extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'portlet');


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
    public function contentClassName($value = '')
    {
        return $this->set('contentClassName', $value);
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
    public function divider($value = '')
    {
        return $this->set('divider', $value);
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
    public function hideHeader($value = '')
    {
        return $this->set('hideHeader', $value);
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
    public function linksClassName($value = '')
    {
        return $this->set('linksClassName', $value);
    }

    /**
     * 
     */
    public function mountOnEnter($value = '')
    {
        return $this->set('mountOnEnter', $value);
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
    public function scrollable($value = true)
    {
        return $this->set('scrollable', $value);
    }

    /**
     * 
     */
    public function source($value = '')
    {
        return $this->set('source', $value);
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
    public function tabs($value = '')
    {
        return $this->set('tabs', $value);
    }

    /**
     * 
     */
    public function tabsClassName($value = '')
    {
        return $this->set('tabsClassName', $value);
    }

    /**
     * 
     */
    public function tabsMode($value = '')
    {
        return $this->set('tabsMode', $value);
    }

    /**
     * 
     */
    public function toolbar($value = '')
    {
        return $this->set('toolbar', $value);
    }

    /**
     * 
     */
    public function type($value = 'portlet')
    {
        return $this->set('type', $value);
    }

    /**
     * 
     */
    public function unmountOnExit($value = '')
    {
        return $this->set('unmountOnExit', $value);
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
