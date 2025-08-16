<?php

namespace Slowlyo\OwlAdmin\Renderers;

use Slowlyo\OwlAdmin\Traits\UploadTrait;

/**
 * File 文件上传控件 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/file
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class FileControl extends BaseRenderer
{
    use UploadTrait;

    public function __construct()
    {
        $this->set('type', 'input-file');

        $this->receiver(admin_url('upload_file'));
        $this->startChunkApi(admin_url('upload_chunk_start'));
        $this->chunkApi(admin_url('upload_chunk'));
        $this->finishChunkApi(admin_url('upload_chunk_finish'));
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
    public function asBase64($value = '')
    {
        return $this->set('asBase64', $value);
    }

    /**
     * 
     */
    public function asBlob($value = '')
    {
        return $this->set('asBlob', $value);
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
    public function btnLabel($value = '')
    {
        return $this->set('btnLabel', $value);
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
    public function chunkApi($value = '')
    {
        return $this->set('chunkApi', $value);
    }

    /**
     * 
     */
    public function chunkSize($value = '')
    {
        return $this->set('chunkSize', $value);
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
    public function concurrency($value = '')
    {
        return $this->set('concurrency', $value);
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
    public function documentLink($value = '')
    {
        return $this->set('documentLink', $value);
    }

    /**
     * 
     */
    public function documentation($value = '')
    {
        return $this->set('documentation', $value);
    }

    /**
     * 
     */
    public function downloadUrl($value = '')
    {
        return $this->set('downloadUrl', $value);
    }

    /**
     * 
     */
    public function drag($value = '')
    {
        return $this->set('drag', $value);
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
    public function fileField($value = '')
    {
        return $this->set('fileField', $value);
    }

    /**
     * 
     */
    public function finishChunkApi($value = '')
    {
        return $this->set('finishChunkApi', $value);
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
    public function nameField($value = '')
    {
        return $this->set('nameField', $value);
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
    public function size($value = '')
    {
        return $this->set('size', $value);
    }

    /**
     * 
     */
    public function startChunkApi($value = '')
    {
        return $this->set('startChunkApi', $value);
    }

    /**
     * 
     */
    public function stateTextMap($value = '')
    {
        return $this->set('stateTextMap', $value);
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
    public function templateUrl($value = '')
    {
        return $this->set('templateUrl', $value);
    }

    /**
     * 
     */
    public function type($value = 'input-file')
    {
        return $this->set('type', $value);
    }

    /**
     * 
     */
    public function urlField($value = '')
    {
        return $this->set('urlField', $value);
    }

    /**
     * 
     */
    public function useChunk($value = '')
    {
        return $this->set('useChunk', $value);
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
