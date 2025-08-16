<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Button Group 渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/button-group
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class BaseButtonGroup extends BaseRenderer
{
    public function __construct()
    {
        

    }

    /**
     * 
     */
    public function btnActiveClassName($value = '')
    {
        return $this->set('btnActiveClassName', $value);
    }

    /**
     * 
     */
    public function btnActiveLevel($value = '')
    {
        return $this->set('btnActiveLevel', $value);
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
    public function btnLevel($value = '')
    {
        return $this->set('btnLevel', $value);
    }

    /**
     * 
     */
    public function buttons($value = '')
    {
        return $this->set('buttons', $value);
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
    public function tiled($value = '')
    {
        return $this->set('tiled', $value);
    }

    /**
     * 
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
    public function vertical($value = '')
    {
        return $this->set('vertical', $value);
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
