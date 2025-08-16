<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * CRUDTable
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class CRUDTable extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'crud');


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
    public function affixRow($value = '')
    {
        return $this->set('affixRow', $value);
    }

    /**
     * 
     */
    public function alwaysShowPagination($value = '')
    {
        return $this->set('alwaysShowPagination', $value);
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
    public function autoGenerateFilter($value = '')
    {
        return $this->set('autoGenerateFilter', $value);
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
    public function bulkActions($value = '')
    {
        return $this->set('bulkActions', $value);
    }

    /**
     * 
     */
    public function canAccessSuperData($value = '')
    {
        return $this->set('canAccessSuperData', $value);
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
    public function columns($value = '')
    {
        return $this->set('columns', $value);
    }

    /**
     * 
     */
    public function columnsTogglable($value = true)
    {
        return $this->set('columnsTogglable', $value);
    }

    /**
     * 
     */
    public function combineFromIndex($value = '')
    {
        return $this->set('combineFromIndex', $value);
    }

    /**
     * 
     */
    public function combineNum($value = '')
    {
        return $this->set('combineNum', $value);
    }

    /**
     * 设置数据
     */
    public function data($value = '')
    {
        return $this->set('data', $value);
    }

    /**
     * 
     */
    public function defaultParams($value = '')
    {
        return $this->set('defaultParams', $value);
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
    public function draggable($value = true)
    {
        return $this->set('draggable', $value);
    }

    /**
     * 
     */
    public function draggableOn($value = '')
    {
        return $this->set('draggableOn', $value);
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
    public function expandConfig($value = '')
    {
        return $this->set('expandConfig', $value);
    }

    /**
     * 
     */
    public function filter($value = '')
    {
        return $this->set('filter', $value);
    }

    /**
     * 
     */
    public function filterDefaultVisible($value = '')
    {
        return $this->set('filterDefaultVisible', $value);
    }

    /**
     * 
     */
    public function filterTogglable($value = true)
    {
        return $this->set('filterTogglable', $value);
    }

    /**
     * 
     */
    public function footable($value = true)
    {
        return $this->set('footable', $value);
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
    public function initFetch($value = '')
    {
        return $this->set('initFetch', $value);
    }

    /**
     * 
     */
    public function initFetchOn($value = '')
    {
        return $this->set('initFetchOn', $value);
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
    public function interval($value = '')
    {
        return $this->set('interval', $value);
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
     * 约束批量操作
     */
    public function itemCheckableOn($value = '')
    {
        return $this->set('itemCheckableOn', $value);
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
    public function labelTpl($value = '')
    {
        return $this->set('labelTpl', $value);
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
    public function loadDataOnceFetchOnFilter($value = '')
    {
        return $this->set('loadDataOnceFetchOnFilter', $value);
    }

    /**
     * 
     */
    public function loadMoreProps($value = '')
    {
        return $this->set('loadMoreProps', $value);
    }

    /**
     * 
     */
    public function matchFunc($value = '')
    {
        return $this->set('matchFunc', $value);
    }

    /**
     * 
     */
    public function maxKeepItemSelectionLength($value = '')
    {
        return $this->set('maxKeepItemSelectionLength', $value);
    }

    /**
     * 
     */
    public function messages($value = '')
    {
        return $this->set('messages', $value);
    }

    /**
     * 
     */
    public function mode($value = 'table')
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
    public function orderBy($value = '')
    {
        return $this->set('orderBy', $value);
    }

    /**
     * 
     */
    public function orderDir($value = '')
    {
        return $this->set('orderDir', $value);
    }

    /**
     * 
     */
    public function orderField($value = '')
    {
        return $this->set('orderField', $value);
    }

    /**
     * 
     */
    public function pageDirectionField($value = '')
    {
        return $this->set('pageDirectionField', $value);
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
    public function perPageAvailable($value = true)
    {
        return $this->set('perPageAvailable', $value);
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
    public function persistKey($value = '')
    {
        return $this->set('persistKey', $value);
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
    public function prefixRow($value = '')
    {
        return $this->set('prefixRow', $value);
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
    public function resizable($value = true)
    {
        return $this->set('resizable', $value);
    }

    /**
     * 
     */
    public function rowClassNameExpr($value = '')
    {
        return $this->set('rowClassNameExpr', $value);
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
    public function showIndex($value = '')
    {
        return $this->set('showIndex', $value);
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
    public function stopAutoRefreshWhenModalIsOpen($value = '')
    {
        return $this->set('stopAutoRefreshWhenModalIsOpen', $value);
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
    public function tableClassName($value = '')
    {
        return $this->set('tableClassName', $value);
    }

    /**
     * 
     */
    public function tableLayout($value = '')
    {
        return $this->set('tableLayout', $value);
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
    public function toolbar($value = '')
    {
        return $this->set('toolbar', $value);
    }

    /**
     * 
     */
    public function toolbarClassName($value = '')
    {
        return $this->set('toolbarClassName', $value);
    }

    /**
     * 
     */
    public function toolbarInline($value = '')
    {
        return $this->set('toolbarInline', $value);
    }

    /**
     * 
     */
    public function totalField($value = '')
    {
        return $this->set('totalField', $value);
    }

    /**
     * 
     */
    public function type($value = 'crud')
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
