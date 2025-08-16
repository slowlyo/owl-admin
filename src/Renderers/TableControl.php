<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * TableControl
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class TableControl extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'input-table');


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
    public function addBtnIcon($value = '')
    {
        return $this->set('addBtnIcon', $value);
    }

    /**
     * 
     */
    public function addBtnLabel($value = '')
    {
        return $this->set('addBtnLabel', $value);
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
    public function autoFill($value = '')
    {
        return $this->set('autoFill', $value);
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
    public function canAccessSuperData($value = '')
    {
        return $this->set('canAccessSuperData', $value);
    }

    /**
     * 
     */
    public function cancelBtnIcon($value = '')
    {
        return $this->set('cancelBtnIcon', $value);
    }

    /**
     * 
     */
    public function cancelBtnLabel($value = '')
    {
        return $this->set('cancelBtnLabel', $value);
    }

    /**
     * 
     */
    public function childrenAddable($value = true)
    {
        return $this->set('childrenAddable', $value);
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
     * 
     */
    public function confirmBtnIcon($value = '')
    {
        return $this->set('confirmBtnIcon', $value);
    }

    /**
     * 
     */
    public function confirmBtnLabel($value = '')
    {
        return $this->set('confirmBtnLabel', $value);
    }

    /**
     * 
     */
    public function copyAddBtn($value = '')
    {
        return $this->set('copyAddBtn', $value);
    }

    /**
     * 
     */
    public function copyBtnIcon($value = '')
    {
        return $this->set('copyBtnIcon', $value);
    }

    /**
     * 
     */
    public function copyBtnLabel($value = '')
    {
        return $this->set('copyBtnLabel', $value);
    }

    /**
     * 
     */
    public function copyData($value = '')
    {
        return $this->set('copyData', $value);
    }

    /**
     * 
     */
    public function copyable($value = true)
    {
        return $this->set('copyable', $value);
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
    public function deleteApi($value = '')
    {
        return $this->set('deleteApi', $value);
    }

    /**
     * 
     */
    public function deleteBtnIcon($value = '')
    {
        return $this->set('deleteBtnIcon', $value);
    }

    /**
     * 
     */
    public function deleteBtnLabel($value = '')
    {
        return $this->set('deleteBtnLabel', $value);
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
    public function draggable($value = true)
    {
        return $this->set('draggable', $value);
    }

    /**
     * 
     */
    public function editBtnIcon($value = '')
    {
        return $this->set('editBtnIcon', $value);
    }

    /**
     * 
     */
    public function editBtnLabel($value = '')
    {
        return $this->set('editBtnLabel', $value);
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
    public function enableStaticTransform($value = '')
    {
        return $this->set('enableStaticTransform', $value);
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
    public function footable($value = true)
    {
        return $this->set('footable', $value);
    }

    /**
     * 
     */
    public function footerAddBtn($value = '')
    {
        return $this->set('footerAddBtn', $value);
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
    public function itemBadge($value = '')
    {
        return $this->set('itemBadge', $value);
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
    public function matchFunc($value = '')
    {
        return $this->set('matchFunc', $value);
    }

    /**
     * 
     */
    public function maxLength($value = '')
    {
        return $this->set('maxLength', $value);
    }

    /**
     * 
     */
    public function minLength($value = '')
    {
        return $this->set('minLength', $value);
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
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 
     */
    public function needConfirm($value = '')
    {
        return $this->set('needConfirm', $value);
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
    public function perPage($value = '')
    {
        return $this->set('perPage', $value);
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
    public function resizable($value = true)
    {
        return $this->set('resizable', $value);
    }

    /**
     * 
     */
    public function row($value = '')
    {
        return $this->set('row', $value);
    }

    /**
     * 
     */
    public function rowClassNameExpr($value = '')
    {
        return $this->set('rowClassNameExpr', $value);
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
    public function scaffold($value = '')
    {
        return $this->set('scaffold', $value);
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
    public function showFooterAddBtn($value = '')
    {
        return $this->set('showFooterAddBtn', $value);
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
    public function showTableAddBtn($value = '')
    {
        return $this->set('showTableAddBtn', $value);
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
    public function subAddBtnIcon($value = '')
    {
        return $this->set('subAddBtnIcon', $value);
    }

    /**
     * 
     */
    public function subAddBtnLabel($value = '')
    {
        return $this->set('subAddBtnLabel', $value);
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
    public function toolbarClassName($value = '')
    {
        return $this->set('toolbarClassName', $value);
    }

    /**
     * 
     */
    public function type($value = 'input-table')
    {
        return $this->set('type', $value);
    }

    /**
     * 
     */
    public function updateApi($value = '')
    {
        return $this->set('updateApi', $value);
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

    /**
     * 在Table中调整宽度
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }


}
