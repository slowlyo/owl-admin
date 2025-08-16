<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * CRUD2List
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class CRUD2List extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'crud2');
$this->set('mode', 'list');


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
    public function api($value = '')
    {
        return $this->set('api', $value);
    }

    /**
     * 
     */
    public function autoFillHeight($value = '')
    {
        return $this->set('autoFillHeight', $value);
    }

    /**
     * 
     */
    public function autoJumpToTopOnPagerChange($value = '')
    {
        return $this->set('autoJumpToTopOnPagerChange', $value);
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
    public function footerToolbar($value = '')
    {
        return $this->set('footerToolbar', $value);
    }

    /**
     * 
     */
    public function footerToolbarClassName($value = '')
    {
        return $this->set('footerToolbarClassName', $value);
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
    public function headerToolbar($value = '')
    {
        return $this->set('headerToolbar', $value);
    }

    /**
     * 
     */
    public function headerToolbarClassName($value = '')
    {
        return $this->set('headerToolbarClassName', $value);
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
    public function hideQuickSaveBtn($value = '')
    {
        return $this->set('hideQuickSaveBtn', $value);
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
    public function interval($value = '')
    {
        return $this->set('interval', $value);
    }

    /**
     * 
     */
    public function itemAction($value = '')
    {
        return $this->set('itemAction', $value);
    }

    /**
     * 约束批量操作
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
    public function keepItemSelectionOnPageChange($value = '')
    {
        return $this->set('keepItemSelectionOnPageChange', $value);
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
    public function loadDataOnce($value = '')
    {
        return $this->set('loadDataOnce', $value);
    }

    /**
     * 
     */
    public function loadType($value = '')
    {
        return $this->set('loadType', $value);
    }

    /**
     * 
     */
    public function loadingConfig($value = '')
    {
        return $this->set('loadingConfig', $value);
    }

    /**
     * 
     */
    public function mode($value = 'list')
    {
        return $this->set('mode', $value);
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
    public function pageField($value = '')
    {
        return $this->set('pageField', $value);
    }

    /**
     * 
     */
    public function parsePrimitiveQuery($value = '')
    {
        return $this->set('parsePrimitiveQuery', $value);
    }

    /**
     * 
     */
    public function perPage($value = '')
    {
        return $this->set('perPage', $value);
    }

    /**
     * 
     */
    public function perPageField($value = '')
    {
        return $this->set('perPageField', $value);
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
    public function primaryField($value = '')
    {
        return $this->set('primaryField', $value);
    }

    /**
     * 
     */
    public function pullRefresh($value = '')
    {
        return $this->set('pullRefresh', $value);
    }

    /**
     * 
     */
    public function quickSaveApi($value = '')
    {
        return $this->set('quickSaveApi', $value);
    }

    /**
     * 
     */
    public function quickSaveItemApi($value = '')
    {
        return $this->set('quickSaveItemApi', $value);
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
    public function selectable($value = true)
    {
        return $this->set('selectable', $value);
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
    public function showSelection($value = '')
    {
        return $this->set('showSelection', $value);
    }

    /**
     * 
     */
    public function silentPolling($value = '')
    {
        return $this->set('silentPolling', $value);
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
    public function stopAutoRefreshWhen($value = '')
    {
        return $this->set('stopAutoRefreshWhen', $value);
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
    public function syncLocation($value = '')
    {
        return $this->set('syncLocation', $value);
    }

    /**
     * 
     */
    public function syncResponse2Query($value = '')
    {
        return $this->set('syncResponse2Query', $value);
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
    public function type($value = 'crud2')
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
