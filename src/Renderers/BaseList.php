<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * List 列表展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/card
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class BaseList extends BaseRenderer
{
    public function __construct()
    {
        

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
    public function affixHeader($value = '')
    {
        return $this->set('affixHeader', $value);
    }

    /**
     * 
     */
    public function checkOnItemClick($value = '')
    {
        return $this->set('checkOnItemClick', $value);
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
    public function hideCheckToggler($value = '')
    {
        return $this->set('hideCheckToggler', $value);
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
    public function indexBarOffset($value = '')
    {
        return $this->set('indexBarOffset', $value);
    }

    /**
     * 
     */
    public function indexField($value = '')
    {
        return $this->set('indexField', $value);
    }

    /**
     * 
     */
    public function itemAction($value = '')
    {
        return $this->set('itemAction', $value);
    }

    /**
     * 
     */
    public function itemCheckableOn($value = '')
    {
        return $this->set('itemCheckableOn', $value);
    }

    /**
     * 
     */
    public function itemDraggableOn($value = '')
    {
        return $this->set('itemDraggableOn', $value);
    }

    /**
     * 
     */
    public function listItem($value = '')
    {
        return $this->set('listItem', $value);
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
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 
     */
    public function showFooter($value = '')
    {
        return $this->set('showFooter', $value);
    }

    /**
     * 
     */
    public function showHeader($value = '')
    {
        return $this->set('showHeader', $value);
    }

    /**
     * 
     */
    public function showIndexBar($value = '')
    {
        return $this->set('showIndexBar', $value);
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
    public function valueField($value = '')
    {
        return $this->set('valueField', $value);
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
