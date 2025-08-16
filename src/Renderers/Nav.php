<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Nav 导航渲染器 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/nav
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Nav extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'nav');


    }

    /**
     * 
     */
    public function accordion($value = '')
    {
        return $this->set('accordion', $value);
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
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 
     */
    public function collapsed($value = '')
    {
        return $this->set('collapsed', $value);
    }

    /**
     * 
     */
    public function defaultOpenLevel($value = '')
    {
        return $this->set('defaultOpenLevel', $value);
    }

    /**
     * 
     */
    public function deferApi($value = '')
    {
        return $this->set('deferApi', $value);
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
    public function dragOnSameLevel($value = '')
    {
        return $this->set('dragOnSameLevel', $value);
    }

    /**
     * 
     */
    public function draggable($value = true)
    {
        return $this->set('draggable', $value);
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
    public function expandIcon($value = '')
    {
        return $this->set('expandIcon', $value);
    }

    /**
     * 
     */
    public function expandPosition($value = '')
    {
        return $this->set('expandPosition', $value);
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
    public function indentSize($value = '')
    {
        return $this->set('indentSize', $value);
    }

    /**
     * 
     */
    public function itemActions($value = '')
    {
        return $this->set('itemActions', $value);
    }

    /**
     * 
     */
    public function itemBadge($value = '')
    {
        return $this->set('itemBadge', $value);
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
    public function links($value = '')
    {
        return $this->set('links', $value);
    }

    /**
     * 
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
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
    public function overflow($value = '')
    {
        return $this->set('overflow', $value);
    }

    /**
     * 
     */
    public function popupClassName($value = '')
    {
        return $this->set('popupClassName', $value);
    }

    /**
     * 
     */
    public function saveOrderApi($value = '')
    {
        return $this->set('saveOrderApi', $value);
    }

    /**
     * 
     */
    public function searchConfig($value = '')
    {
        return $this->set('searchConfig', $value);
    }

    /**
     * 
     */
    public function searchable($value = true)
    {
        return $this->set('searchable', $value);
    }

    /**
     * 
     */
    public function showKey($value = '')
    {
        return $this->set('showKey', $value);
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
    public function stacked($value = '')
    {
        return $this->set('stacked', $value);
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
    public function themeColor($value = '')
    {
        return $this->set('themeColor', $value);
    }

    /**
     * 
     */
    public function type($value = 'nav')
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
