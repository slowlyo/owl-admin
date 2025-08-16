<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * TableSchema2
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class TableSchema2 extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'table2');


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
    public function autoFillHeight($value = '')
    {
        return $this->set('autoFillHeight', $value);
    }

    /**
     * 
     */
    public function bordered($value = '')
    {
        return $this->set('bordered', $value);
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
    public function childrenColumnName($value = '')
    {
        return $this->set('childrenColumnName', $value);
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
    public function expandable($value = true)
    {
        return $this->set('expandable', $value);
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
    public function itemBadge($value = '')
    {
        return $this->set('itemBadge', $value);
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
    public function keyField($value = '')
    {
        return $this->set('keyField', $value);
    }

    /**
     * 
     */
    public function lazyRenderAfter($value = '')
    {
        return $this->set('lazyRenderAfter', $value);
    }

    /**
     * 
     */
    public function lineHeight($value = '')
    {
        return $this->set('lineHeight', $value);
    }

    /**
     * 
     */
    public function loading($value = '')
    {
        return $this->set('loading', $value);
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
    public function multiple($value = '')
    {
        return $this->set('multiple', $value);
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
    public function popOverContainer($value = '')
    {
        return $this->set('popOverContainer', $value);
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
    public function reload($value = '')
    {
        return $this->set('reload', $value);
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
    public function rowSelection($value = '')
    {
        return $this->set('rowSelection', $value);
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
    public function showBadge($value = '')
    {
        return $this->set('showBadge', $value);
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
    public function sticky($value = '')
    {
        return $this->set('sticky', $value);
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
    public function type($value = 'table2')
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
