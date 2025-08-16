<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Panel渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/panel
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Panel extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'panel');


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
    public function actionsClassName($value = '')
    {
        return $this->set('actionsClassName', $value);
    }

    /**
     * 
     */
    public function actionsControlClassName($value = '')
    {
        return $this->set('actionsControlClassName', $value);
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
    public function bodyControlClassName($value = '')
    {
        return $this->set('bodyControlClassName', $value);
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
    public function collapsible($value = '')
    {
        return $this->set('collapsible', $value);
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
    public function footerWrapClassName($value = '')
    {
        return $this->set('footerWrapClassName', $value);
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
    public function headerControlClassName($value = '')
    {
        return $this->set('headerControlClassName', $value);
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
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
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
    public function subFormHorizontal($value = '')
    {
        return $this->set('subFormHorizontal', $value);
    }

    /**
     * 
     */
    public function subFormMode($value = '')
    {
        return $this->set('subFormMode', $value);
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
    public function type($value = 'panel')
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
