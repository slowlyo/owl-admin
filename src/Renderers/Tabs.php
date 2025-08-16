<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 选项卡控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/tabs
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Tabs extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'tabs');


    }

    /**
     * 
     */
    public function activeKey($value = '')
    {
        return $this->set('activeKey', $value);
    }

    /**
     * 
     */
    public function addBtnText($value = '')
    {
        return $this->set('addBtnText', $value);
    }

    /**
     * 
     */
    public function addable($value = true)
    {
        return $this->set('addable', $value);
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
    public function closable($value = true)
    {
        return $this->set('closable', $value);
    }

    /**
     * 
     */
    public function collapseBtnLabel($value = '')
    {
        return $this->set('collapseBtnLabel', $value);
    }

    /**
     * 
     */
    public function collapseOnExceed($value = '')
    {
        return $this->set('collapseOnExceed', $value);
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
    public function defaultKey($value = '')
    {
        return $this->set('defaultKey', $value);
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
    public function draggable($value = true)
    {
        return $this->set('draggable', $value);
    }

    /**
     * 
     */
    public function editable($value = true)
    {
        return $this->set('editable', $value);
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
    public function showTip($value = '')
    {
        return $this->set('showTip', $value);
    }

    /**
     * 
     */
    public function showTipClassName($value = '')
    {
        return $this->set('showTipClassName', $value);
    }

    /**
     * 
     */
    public function sidePosition($value = '')
    {
        return $this->set('sidePosition', $value);
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
    public function swipeable($value = true)
    {
        return $this->set('swipeable', $value);
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
    public function tabsMode($value = '')
    {
        return $this->set('tabsMode', $value);
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
    public function toolbar($value = '')
    {
        return $this->set('toolbar', $value);
    }

    /**
     * 
     */
    public function type($value = 'tabs')
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
