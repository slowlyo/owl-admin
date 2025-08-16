<?php

namespace Slowlyo\OwlAdmin\Renderers;

use Slowlyo\OwlAdmin\Traits\UploadTrait;

/**
 * Image 图片上传控件 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/image
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class ImageControl extends BaseRenderer
{
    use UploadTrait;

    public function __construct()
    {
        $this->set('type', 'input-image');

        $this->receiver($this->uploadImagePath());
    }

    /**
     * 
     */
    public function accept($value = '')
    {
        return $this->set('accept', $value);
    }

    /**
     * 
     */
    public function allowInput($value = '')
    {
        return $this->set('allowInput', $value);
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
    public function autoUpload($value = '')
    {
        return $this->set('autoUpload', $value);
    }

    /**
     * 
     */
    public function btnClassName($value = '')
    {
        return $this->set('btnClassName', $value);
    }

    /**
     * 
     */
    public function btnUploadClassName($value = '')
    {
        return $this->set('btnUploadClassName', $value);
    }

    /**
     * 
     */
    public function capture($value = '')
    {
        return $this->set('capture', $value);
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
    public function compress($value = '')
    {
        return $this->set('compress', $value);
    }

    /**
     * 
     */
    public function compressOptions($value = '')
    {
        return $this->set('compressOptions', $value);
    }

    /**
     * 
     */
    public function crop($value = '')
    {
        return $this->set('crop', $value);
    }

    /**
     * 
     */
    public function cropFormat($value = '')
    {
        return $this->set('cropFormat', $value);
    }

    /**
     * 
     */
    public function cropQuality($value = '')
    {
        return $this->set('cropQuality', $value);
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
    public function draggable($value = true)
    {
        return $this->set('draggable', $value);
    }

    /**
     * 
     */
    public function draggableTip($value = '')
    {
        return $this->set('draggableTip', $value);
    }

    /**
     * 
     */
    public function dropCrop($value = '')
    {
        return $this->set('dropCrop', $value);
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
    public function fixedSize($value = '')
    {
        return $this->set('fixedSize', $value);
    }

    /**
     * 
     */
    public function fixedSizeClassName($value = '')
    {
        return $this->set('fixedSizeClassName', $value);
    }

    /**
     * 
     */
    public function frameImage($value = '')
    {
        return $this->set('frameImage', $value);
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
    public function hideUploadButton($value = '')
    {
        return $this->set('hideUploadButton', $value);
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
    public function imageClassName($value = '')
    {
        return $this->set('imageClassName', $value);
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
    public function initCrop($value = '')
    {
        return $this->set('initCrop', $value);
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
    public function invalidSizeMessage($value = '')
    {
        return $this->set('invalidSizeMessage', $value);
    }

    /**
     * 
     */
    public function invalidTypeMessage($value = '')
    {
        return $this->set('invalidTypeMessage', $value);
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
    public function limit($value = '')
    {
        return $this->set('limit', $value);
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
    public function maxSize($value = '')
    {
        return $this->set('maxSize', $value);
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
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 
     */
    public function reCropable($value = true)
    {
        return $this->set('reCropable', $value);
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
    public function receiver($value = '')
    {
        return $this->set('receiver', $value);
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
    public function showCompressOptions($value = '')
    {
        return $this->set('showCompressOptions', $value);
    }

    /**
     * 
     */
    public function showErrorModal($value = '')
    {
        return $this->set('showErrorModal', $value);
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
    public function submitOnChange($value = '')
    {
        return $this->set('submitOnChange', $value);
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
    public function type($value = 'input-image')
    {
        return $this->set('type', $value);
    }

    /**
     * 
     */
    public function uploadBtnText($value = '')
    {
        return $this->set('uploadBtnText', $value);
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
