<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Editor 代码编辑器 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/editor
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class EditorControl extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'editor');


    }

    /**
     * 
     */
    public function allowFullscreen($value = '')
    {
        return $this->set('allowFullscreen', $value);
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
    public function editorDidMount($value = '')
    {
        return $this->set('editorDidMount', $value);
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
    public function language($value = '')
    {
        return $this->set('language', $value);
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
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * monaco 编辑器的其它配置，比如是否显示行号等，不过无法设置 readOnly，只读模式需要使用 disabled: true
     */
    public function options($value = '')
    {
        return $this->set('options', $value);
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
    public function required($value = '')
    {
        return $this->set('required', $value);
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
     *  可选值: editor | bat-editor | c-editor | coffeescript-editor | cpp-editor | csharp-editor | css-editor | dockerfile-editor | fsharp-editor | go-editor | handlebars-editor | html-editor | ini-editor | java-editor | javascript-editor | json-editor | less-editor | lua-editor | markdown-editor | msdax-editor | objective-c-editor | php-editor | plaintext-editor | postiats-editor | powershell-editor | pug-editor | python-editor | r-editor | razor-editor | ruby-editor | sb-editor | scss-editor | sol-editor | sql-editor | swift-editor | typescript-editor | vb-editor | xml-editor | yaml-editor
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
