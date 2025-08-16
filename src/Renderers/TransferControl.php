<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Transfer 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/transfer
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class TransferControl extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'transfer');


    }

    /**
     * 
     */
    public function addApi($value = '')
    {
        return $this->set('addApi', $value);
    }

    /**
     * 
     */
    public function addControls($value = '')
    {
        return $this->set('addControls', $value);
    }

    /**
     * 
     */
    public function addDialog($value = '')
    {
        return $this->set('addDialog', $value);
    }

    /**
     * 
     */
    public function autoCheckChildren($value = '')
    {
        return $this->set('autoCheckChildren', $value);
    }

    /**
     * 
     */
    public function autoFill($value = '')
    {
        return $this->set('autoFill', $value);
    }

    /**
     * 
     */
    public function checkAll($value = '')
    {
        return $this->set('checkAll', $value);
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
    public function clearValueOnHidden($value = '')
    {
        return $this->set('clearValueOnHidden', $value);
    }

    /**
     * 
     */
    public function clearValueOnSourceChange($value = '')
    {
        return $this->set('clearValueOnSourceChange', $value);
    }

    /**
     * 
     */
    public function clearable($value = true)
    {
        return $this->set('clearable', $value);
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
    public function creatable($value = true)
    {
        return $this->set('creatable', $value);
    }

    /**
     * 
     */
    public function createBtnLabel($value = '')
    {
        return $this->set('createBtnLabel', $value);
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
    public function deferField($value = '')
    {
        return $this->set('deferField', $value);
    }

    /**
     * 
     */
    public function deleteApi($value = '')
    {
        return $this->set('deleteApi', $value);
    }

    /**
     * 
     */
    public function deleteConfirmText($value = '')
    {
        return $this->set('deleteConfirmText', $value);
    }

    /**
     * 
     */
    public function delimiter($value = '')
    {
        return $this->set('delimiter', $value);
    }

    /**
     * 
     */
    public function desc($value = '')
    {
        return $this->set('desc', $value);
    }

    /**
     * 
     */
    public function description($value = '')
    {
        return $this->set('description', $value);
    }

    /**
     * 
     */
    public function descriptionClassName($value = '')
    {
        return $this->set('descriptionClassName', $value);
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
    public function editApi($value = '')
    {
        return $this->set('editApi', $value);
    }

    /**
     * 
     */
    public function editControls($value = '')
    {
        return $this->set('editControls', $value);
    }

    /**
     * 
     */
    public function editDialog($value = '')
    {
        return $this->set('editDialog', $value);
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
    public function extraName($value = '')
    {
        return $this->set('extraName', $value);
    }

    /**
     * 
     */
    public function extractValue($value = '')
    {
        return $this->set('extractValue', $value);
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
    public function hint($value = '')
    {
        return $this->set('hint', $value);
    }

    /**
     * 
     */
    public function horizontal($value = '')
    {
        return $this->set('horizontal', $value);
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
    public function initAutoFill($value = '')
    {
        return $this->set('initAutoFill', $value);
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
    public function initiallyOpen($value = '')
    {
        return $this->set('initiallyOpen', $value);
    }

    /**
     * 
     */
    public function inline($value = '')
    {
        return $this->set('inline', $value);
    }

    /**
     * 
     */
    public function inputClassName($value = '')
    {
        return $this->set('inputClassName', $value);
    }

    /**
     * 
     */
    public function itemHeight($value = '')
    {
        return $this->set('itemHeight', $value);
    }

    /**
     * 
     */
    public function joinValues($value = '')
    {
        return $this->set('joinValues', $value);
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
    public function labelAlign($value = '')
    {
        return $this->set('labelAlign', $value);
    }

    /**
     * 
     */
    public function labelClassName($value = '')
    {
        return $this->set('labelClassName', $value);
    }

    /**
     * 
     */
    public function labelOverflow($value = '')
    {
        return $this->set('labelOverflow', $value);
    }

    /**
     * 
     */
    public function labelRemark($value = '')
    {
        return $this->set('labelRemark', $value);
    }

    /**
     * 
     */
    public function labelWidth($value = '')
    {
        return $this->set('labelWidth', $value);
    }

    /**
     * 
     */
    public function leftMode($value = '')
    {
        return $this->set('leftMode', $value);
    }

    /**
     * 
     */
    public function leftOptions($value = '')
    {
        return $this->set('leftOptions', $value);
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
    public function menuTpl($value = '')
    {
        return $this->set('menuTpl', $value);
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
    public function onlyChildren($value = '')
    {
        return $this->set('onlyChildren', $value);
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
    public function pagination($value = '')
    {
        return $this->set('pagination', $value);
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
    public function readOnly($value = '')
    {
        return $this->set('readOnly', $value);
    }

    /**
     * 
     */
    public function readOnlyOn($value = '')
    {
        return $this->set('readOnlyOn', $value);
    }

    /**
     * 
     */
    public function remark($value = '')
    {
        return $this->set('remark', $value);
    }

    /**
     * 
     */
    public function removable($value = true)
    {
        return $this->set('removable', $value);
    }

    /**
     * 
     */
    public function required($value = '')
    {
        return $this->set('required', $value);
    }

    /**
     * 
     */
    public function resetValue($value = '')
    {
        return $this->set('resetValue', $value);
    }

    /**
     * 
     */
    public function resultListModeFollowSelect($value = '')
    {
        return $this->set('resultListModeFollowSelect', $value);
    }

    /**
     * 
     */
    public function resultSearchPlaceholder($value = '')
    {
        return $this->set('resultSearchPlaceholder', $value);
    }

    /**
     * 
     */
    public function resultSearchable($value = true)
    {
        return $this->set('resultSearchable', $value);
    }

    /**
     * 
     */
    public function resultTitle($value = '')
    {
        return $this->set('resultTitle', $value);
    }

    /**
     * 
     */
    public function rightMode($value = '')
    {
        return $this->set('rightMode', $value);
    }

    /**
     * 
     */
    public function row($value = '')
    {
        return $this->set('row', $value);
    }

    /**
     * 是否立即保存(TableColumn中使用)
     */
    public function saveImmediately($value = true)
    {
        return $this->set('saveImmediately', $value);
    }

    /**
     * 
     */
    public function searchApi($value = '')
    {
        return $this->set('searchApi', $value);
    }

    /**
     * 
     */
    public function searchPlaceholder($value = '')
    {
        return $this->set('searchPlaceholder', $value);
    }

    /**
     * 
     */
    public function searchResultColumns($value = '')
    {
        return $this->set('searchResultColumns', $value);
    }

    /**
     * 
     */
    public function searchResultMode($value = '')
    {
        return $this->set('searchResultMode', $value);
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
    public function selectFirst($value = '')
    {
        return $this->set('selectFirst', $value);
    }

    /**
     * 
     */
    public function selectMode($value = '')
    {
        return $this->set('selectMode', $value);
    }

    /**
     * 
     */
    public function selectTitle($value = '')
    {
        return $this->set('selectTitle', $value);
    }

    /**
     * 
     */
    public function showArrow($value = '')
    {
        return $this->set('showArrow', $value);
    }

    /**
     * 
     */
    public function showInvalidMatch($value = '')
    {
        return $this->set('showInvalidMatch', $value);
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
    public function sortable($value = true)
    {
        return $this->set('sortable', $value);
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
    public function statistics($value = '')
    {
        return $this->set('statistics', $value);
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
    public function submitOnChange($value = '')
    {
        return $this->set('submitOnChange', $value);
    }

    /**
     * 
     */
    public function type($value = 'transfer')
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
    public function validateApi($value = '')
    {
        return $this->set('validateApi', $value);
    }

    /**
     * 
     */
    public function validateOnChange($value = '')
    {
        return $this->set('validateOnChange', $value);
    }

    /**
     * 
     */
    public function validationErrors($value = '')
    {
        return $this->set('validationErrors', $value);
    }

    /**
     * 
     */
    public function validations($value = '')
    {
        return $this->set('validations', $value);
    }

    /**
     * 
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
    }

    /**
     * 
     */
    public function valueTpl($value = '')
    {
        return $this->set('valueTpl', $value);
    }

    /**
     * 
     */
    public function valuesNoWrap($value = '')
    {
        return $this->set('valuesNoWrap', $value);
    }

    /**
     * 
     */
    public function virtualThreshold($value = '')
    {
        return $this->set('virtualThreshold', $value);
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
     * 在Table中调整宽度
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }


}
