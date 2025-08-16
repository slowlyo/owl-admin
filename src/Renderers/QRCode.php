<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 二维码展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/qrcode
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class QRCode extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'qrcode');


    }

    /**
     * 
     */
    public function backgroundColor($value = '')
    {
        return $this->set('backgroundColor', $value);
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
    public function codeSize($value = '')
    {
        return $this->set('codeSize', $value);
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
    public function eyeBorderColor($value = '')
    {
        return $this->set('eyeBorderColor', $value);
    }

    /**
     * 
     */
    public function eyeBorderSize($value = '')
    {
        return $this->set('eyeBorderSize', $value);
    }

    /**
     * 
     */
    public function eyeInnerColor($value = '')
    {
        return $this->set('eyeInnerColor', $value);
    }

    /**
     * 
     */
    public function eyeType($value = '')
    {
        return $this->set('eyeType', $value);
    }

    /**
     * 
     */
    public function foregroundColor($value = '')
    {
        return $this->set('foregroundColor', $value);
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
    public function imageSettings($value = '')
    {
        return $this->set('imageSettings', $value);
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
     * 
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 
     */
    public function pointSize($value = '')
    {
        return $this->set('pointSize', $value);
    }

    /**
     * 
     */
    public function pointSizeRandom($value = '')
    {
        return $this->set('pointSizeRandom', $value);
    }

    /**
     * 
     */
    public function pointType($value = '')
    {
        return $this->set('pointType', $value);
    }

    /**
     * 
     */
    public function qrcodeClassName($value = '')
    {
        return $this->set('qrcodeClassName', $value);
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
     *  可选值: qrcode | qr-code
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
