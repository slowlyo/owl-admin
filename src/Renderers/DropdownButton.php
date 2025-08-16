<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 下拉按钮渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/dropdown-button
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class DropdownButton extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'dropdown-button');


    }

    /**
     * 
     */
    public function align($value = '')
    {
        return $this->set('align', $value);
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
    public function btnClassName($value = '')
    {
        return $this->set('btnClassName', $value);
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
    public function closeOnClick($value = '')
    {
        return $this->set('closeOnClick', $value);
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
    public function hideCaret($value = '')
    {
        return $this->set('hideCaret', $value);
    }

    /**
     * 
     */
    public function iconOnly($value = '')
    {
        return $this->set('iconOnly', $value);
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
    public function menuClassName($value = '')
    {
        return $this->set('menuClassName', $value);
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
    public function overlayPlacement($value = '')
    {
        return $this->set('overlayPlacement', $value);
    }

    /**
     * 
     */
    public function popOverContainerSelector($value = '')
    {
        return $this->set('popOverContainerSelector', $value);
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
    public function trigger($value = '')
    {
        return $this->set('trigger', $value);
    }

    /**
     * 
     */
    public function type($value = 'dropdown-button')
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
