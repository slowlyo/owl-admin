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
     * 背景色
     */
    public function backgroundColor($value = '')
    {
        return $this->set('backgroundColor', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 二维码的宽高大小，默认 128
     */
    public function codeSize($value = 128)
    {
        return $this->set('codeSize', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 码眼边框颜色
     */
    public function eyeBorderColor($value = '#000000')
    {
        return $this->set('eyeBorderColor', $value);
    }

    /**
     * 码眼边框大小 可选值: default | sm | xs
     */
    public function eyeBorderSize($value = 'default')
    {
        return $this->set('eyeBorderSize', $value);
    }

    /**
     * 码眼内部颜色
     */
    public function eyeInnerColor($value = '#000000')
    {
        return $this->set('eyeInnerColor', $value);
    }

    /**
     * 码眼类型 可选值: default | circle | rounded
     */
    public function eyeType($value = '')
    {
        return $this->set('eyeType', $value);
    }

    /**
     * 前景色
     */
    public function foregroundColor($value = '')
    {
        return $this->set('foregroundColor', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 图片配置 (图片配置)
     */
    public function imageSettings($value = '')
    {
        return $this->set('imageSettings', $value);
    }

    /**
     * 二维码复杂级别 可选值: L | M | Q | H
     */
    public function level($value = '')
    {
        return $this->set('level', $value);
    }

    /**
     * 渲染模式 可选值: canvas | svg
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 关联字段名。
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 占位符
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 码点大小 可选值: default | sm | xs
     */
    public function pointSize($value = 'default')
    {
        return $this->set('pointSize', $value);
    }

    /**
     * 码点大小随机
     */
    public function pointSizeRandom($value = true)
    {
        return $this->set('pointSizeRandom', $value);
    }

    /**
     * 码点类型 可选值: default | circle
     */
    public function pointType($value = '')
    {
        return $this->set('pointType', $value);
    }

    /**
     * css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function qrcodeClassName($value = '')
    {
        return $this->set('qrcodeClassName', $value);
    }

    /**
     * 是否静态展示
     */
    public function static($value = true)
    {
        return $this->set('static', $value);
    }

    /**
     * 静态展示表单项类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 静态展示表单项Value类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 静态展示表单项Label类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 是否静态展示表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function staticOn($value = '')
    {
        return $this->set('staticOn', $value);
    }

    /**
     * 静态展示空值占位
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
     * 组件样式
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
     * 指定为模板渲染器。文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template
     */
    public function type($value = '')
    {
        return $this->set('type', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
