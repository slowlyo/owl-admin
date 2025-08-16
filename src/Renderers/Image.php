<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 图片展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/image
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Image extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'image');


    }

    /**
     * 
     */
    public function alt($value = '')
    {
        return $this->set('alt', $value);
    }

    /**
     * 
     */
    public function blank($value = '')
    {
        return $this->set('blank', $value);
    }

    /**
     * 
     */
    public function caption($value = '')
    {
        return $this->set('caption', $value);
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
    public function defaultImage($value = '')
    {
        return $this->set('defaultImage', $value);
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
    public function enlargeAble($value = '')
    {
        return $this->set('enlargeAble', $value);
    }

    /**
     * 
     */
    public function enlargeWithGallary($value = '')
    {
        return $this->set('enlargeWithGallary', $value);
    }

    /**
     * 
     */
    public function fontStyle($value = '')
    {
        return $this->set('fontStyle', $value);
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
    public function hoverMode($value = '')
    {
        return $this->set('hoverMode', $value);
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
    public function htmlTarget($value = '')
    {
        return $this->set('htmlTarget', $value);
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
    public function imageCaption($value = '')
    {
        return $this->set('imageCaption', $value);
    }

    /**
     * 
     */
    public function imageClassName($value = '')
    {
        return $this->set('imageClassName', $value);
    }

    /**
     * 
     */
    public function imageGallaryClassName($value = '')
    {
        return $this->set('imageGallaryClassName', $value);
    }

    /**
     * 
     */
    public function imageMode($value = '')
    {
        return $this->set('imageMode', $value);
    }

    /**
     * 
     */
    public function innerClassName($value = '')
    {
        return $this->set('innerClassName', $value);
    }

    /**
     * 
     */
    public function maskColor($value = '')
    {
        return $this->set('maskColor', $value);
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
    public function originalSrc($value = '')
    {
        return $this->set('originalSrc', $value);
    }

    /**
     * 
     */
    public function showToolbar($value = '')
    {
        return $this->set('showToolbar', $value);
    }

    /**
     * 
     */
    public function sortType($value = '')
    {
        return $this->set('sortType', $value);
    }

    /**
     * 
     */
    public function src($value = '')
    {
        return $this->set('src', $value);
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
    public function thumbClassName($value = '')
    {
        return $this->set('thumbClassName', $value);
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
    public function thumbRatio($value = '')
    {
        return $this->set('thumbRatio', $value);
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
    public function toolbarActions($value = '')
    {
        return $this->set('toolbarActions', $value);
    }

    /**
     *  可选值: image | static-image
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

    /**
     * 
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }


}
