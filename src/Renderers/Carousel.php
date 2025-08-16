<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Carousel 轮播图渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/carousel
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Carousel extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'carousel');


    }

    /**
     * 
     */
    public function alwaysShowArrow($value = '')
    {
        return $this->set('alwaysShowArrow', $value);
    }

    /**
     * 
     */
    public function animation($value = '')
    {
        return $this->set('animation', $value);
    }

    /**
     * 
     */
    public function auto($value = '')
    {
        return $this->set('auto', $value);
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
    public function controls($value = '')
    {
        return $this->set('controls', $value);
    }

    /**
     * 
     */
    public function controlsTheme($value = '')
    {
        return $this->set('controlsTheme', $value);
    }

    /**
     * 
     */
    public function direction($value = '')
    {
        return $this->set('direction', $value);
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
    public function duration($value = '')
    {
        return $this->set('duration', $value);
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
    public function icons($value = '')
    {
        return $this->set('icons', $value);
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
    public function interval($value = '')
    {
        return $this->set('interval', $value);
    }

    /**
     * 
     */
    public function itemSchema($value = '')
    {
        return $this->set('itemSchema', $value);
    }

    /**
     * 
     */
    public function loop($value = '')
    {
        return $this->set('loop', $value);
    }

    /**
     * 
     */
    public function mouseEvent($value = '')
    {
        return $this->set('mouseEvent', $value);
    }

    /**
     * 
     */
    public function multiple($value = '')
    {
        return $this->set('multiple', $value);
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
    public function options($value = '')
    {
        return $this->set('options', $value);
    }

    /**
     * 
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
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
    public function thumbMode($value = '')
    {
        return $this->set('thumbMode', $value);
    }

    /**
     * 
     */
    public function type($value = 'carousel')
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
