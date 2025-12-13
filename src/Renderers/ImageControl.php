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
     * 配置接收的图片类型建议直接填写文件后缀 如：.txt,.csv多个类型用逗号隔开。
     */
    public function accept($value = '')
    {
        return $this->set('accept', $value);
    }

    /**
     * 默认都是通过用户选择图片后上传返回图片地址，如果开启此选项，则可以允许用户图片地址。
     */
    public function allowInput($value = true)
    {
        return $this->set('allowInput', $value);
    }

    /**
     * 上传后把其他字段同步到表单内部。
     */
    public function autoFill($value = '')
    {
        return $this->set('autoFill', $value);
    }

    /**
     * 是否自动开始上传
     */
    public function autoUpload($value = true)
    {
        return $this->set('autoUpload', $value);
    }

    /**
     * 选择图片按钮的 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function btnClassName($value = '')
    {
        return $this->set('btnClassName', $value);
    }

    /**
     * 上传按钮的 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function btnUploadClassName($value = '')
    {
        return $this->set('btnUploadClassName', $value);
    }

    /**
     * 可配置移动端的拍照功能，比如配置 `camera` 移动端只能拍照，等
     */
    public function capture($value = '')
    {
        return $this->set('capture', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 表单项隐藏时，是否在当前 Form 中删除掉该表单项值。注意同名的未隐藏的表单项值也会删掉
     */
    public function clearValueOnHidden($value = true)
    {
        return $this->set('clearValueOnHidden', $value);
    }

    /**
     * 
     */
    public function compress($value = true)
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
     * 裁剪后的图片类型
     */
    public function cropFormat($value = '')
    {
        return $this->set('cropFormat', $value);
    }

    /**
     * 裁剪后的质量
     */
    public function cropQuality($value = '')
    {
        return $this->set('cropQuality', $value);
    }

    /**
     * 分割符
     */
    public function delimiter($value = '')
    {
        return $this->set('delimiter', $value);
    }

    /**
     * 描述 (支持两种语法，但是不能混着用。分别是：1. `${xxx}` 或者 `${xxx|upperCase}` 2. `<%= data.xxx %>`
更多文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template)
     */
    public function desc($value = '')
    {
        return $this->set('desc', $value);
    }

    /**
     * 描述内容，支持 Html 片段。
     */
    public function description($value = '')
    {
        return $this->set('description', $value);
    }

    /**
     * 配置描述上的 className (配置描述上的 className)
     */
    public function descriptionClassName($value = '')
    {
        return $this->set('descriptionClassName', $value);
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
     * 是否可拖拽排序
     */
    public function draggable($value = true)
    {
        return $this->set('draggable', $value);
    }

    /**
     * 可拖拽排序的提示信息。
     */
    public function draggableTip($value = '可拖拽排序')
    {
        return $this->set('draggableTip', $value);
    }

    /**
     * 图片上传完毕是否进入裁剪模式
     */
    public function dropCrop($value = true)
    {
        return $this->set('dropCrop', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 额外的字段名，当为范围组件时可以用来将另外一个值打平出来
     */
    public function extraName($value = '')
    {
        return $this->set('extraName', $value);
    }

    /**
     * 开启后将选中的选项 value 的值封装为数组，作为当前表单项的值。
     */
    public function extractValue($value = true)
    {
        return $this->set('extractValue', $value);
    }

    /**
     * 是否开启固定尺寸
     */
    public function fixedSize($value = true)
    {
        return $this->set('fixedSize', $value);
    }

    /**
     * 固定尺寸的 CSS类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function fixedSizeClassName($value = '')
    {
        return $this->set('fixedSizeClassName', $value);
    }

    /**
     * 默认占位图图片地址 (默认占位图图片地址)
     */
    public function frameImage($value = '')
    {
        return $this->set('frameImage', $value);
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
     * 是否隐藏上传按钮
     */
    public function hideUploadButton($value = true)
    {
        return $this->set('hideUploadButton', $value);
    }

    /**
     * 输入提示，聚焦的时候显示
     */
    public function hint($value = '')
    {
        return $this->set('hint', $value);
    }

    /**
     * 当配置为水平布局的时候，用来配置具体的左右分配。 (当配置为水平布局的时候，用来配置具体的左右分配。)
     */
    public function horizontal($value = '')
    {
        return $this->set('horizontal', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 默认展示图片的类名
     */
    public function imageClassName($value = '')
    {
        return $this->set('imageClassName', $value);
    }

    /**
     * 初始化时是否把其他字段同步到表单内部。
     */
    public function initAutoFill($value = true)
    {
        return $this->set('initAutoFill', $value);
    }

    /**
     * 初始化时是否打开裁剪模式
     */
    public function initCrop($value = true)
    {
        return $this->set('initCrop', $value);
    }

    /**
     * 表单 control 是否为 inline 模式。
     */
    public function inline($value = true)
    {
        return $this->set('inline', $value);
    }

    /**
     * 配置 input className (配置 input className)
     */
    public function inputClassName($value = '')
    {
        return $this->set('inputClassName', $value);
    }

    /**
     * 校验文件大小失败时显示的文字信息
     */
    public function invalidSizeMessage($value = '')
    {
        return $this->set('invalidSizeMessage', $value);
    }

    /**
     * 校验格式失败时显示的文字信息
     */
    public function invalidTypeMessage($value = '')
    {
        return $this->set('invalidTypeMessage', $value);
    }

    /**
     * 单选模式：当用户选中某个选项时，选项中的 value 将被作为该表单项的值提交，否则，整个选项对象都会作为该表单项的值提交。 多选模式：选中的多个选项的 `value` 会通过 `delimiter` 连接起来，否则直接将以数组的形式提交值。
     */
    public function joinValues($value = true)
    {
        return $this->set('joinValues', $value);
    }

    /**
     * 描述标题, 当值为 false 时不展示
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 描述标题 (描述标题) 可选值: right | left | top | inherit
     */
    public function labelAlign($value = '')
    {
        return $this->set('labelAlign', $value);
    }

    /**
     * 配置 label className
     */
    public function labelClassName($value = '')
    {
        return $this->set('labelClassName', $value);
    }

    /**
     * label展示形式 可选值: default | ellipsis
     */
    public function labelOverflow($value = '')
    {
        return $this->set('labelOverflow', $value);
    }

    /**
     * 显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起
     */
    public function labelRemark($value = '')
    {
        return $this->set('labelRemark', $value);
    }

    /**
     * label自定义宽度，默认单位为px
     */
    public function labelWidth($value = '')
    {
        return $this->set('labelWidth', $value);
    }

    /**
     * 限制图片大小，超出不让上传。
     */
    public function limit($value = '')
    {
        return $this->set('limit', $value);
    }

    /**
     * 最多的个数
     */
    public function maxLength($value = '')
    {
        return $this->set('maxLength', $value);
    }

    /**
     * 默认没有限制，当设置后，文件大小大于此值将不允许上传。
     */
    public function maxSize($value = '')
    {
        return $this->set('maxSize', $value);
    }

    /**
     * 配置当前表单项展示模式 可选值: normal | inline | horizontal
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 是否为多选
     */
    public function multiple($value = true)
    {
        return $this->set('multiple', $value);
    }

    /**
     * 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
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
     * 是否允许二次裁剪。
     */
    public function reCropable($value = true)
    {
        return $this->set('reCropable', $value);
    }

    /**
     * 是否只读
     */
    public function readOnly($value = true)
    {
        return $this->set('readOnly', $value);
    }

    /**
     * 只读条件
     */
    public function readOnlyOn($value = '')
    {
        return $this->set('readOnlyOn', $value);
    }

    /**
     * 默认 `/api/upload` 如果想自己存储，请设置此选项。 (默认 `/api/upload` 如果想自己存储，请设置此选项。)
     */
    public function receiver($value = '')
    {
        return $this->set('receiver', $value);
    }

    /**
     * 显示一个小图标, 鼠标放上去的时候显示提示内容
     */
    public function remark($value = '')
    {
        return $this->set('remark', $value);
    }

    /**
     * 是否为必填
     */
    public function required($value = true)
    {
        return $this->set('required', $value);
    }

    /**
     * 清除时设置的值
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
     * 默认为 false, 开启后，允许用户输入压缩选项。
     */
    public function showCompressOptions($value = true)
    {
        return $this->set('showCompressOptions', $value);
    }

    /**
     * 格式校验失败是否显示弹窗
     */
    public function showErrorModal($value = true)
    {
        return $this->set('showErrorModal', $value);
    }

    /**
     * 表单项大小 可选值: xs | sm | md | lg | full
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
    }

    /**
     * 默认展示图片的链接 (默认展示图片的链接)
     */
    public function src($value = '')
    {
        return $this->set('src', $value);
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
     * 当修改完的时候是否提交表单。
     */
    public function submitOnChange($value = true)
    {
        return $this->set('submitOnChange', $value);
    }

    /**
     * 缩路图展示模式 可选值: w-full | h-full | contain | cover
     */
    public function thumbMode($value = '')
    {
        return $this->set('thumbMode', $value);
    }

    /**
     * 缩路图展示比率。 可选值: 1:1 | 4:3 | 16:9
     */
    public function thumbRatio($value = '')
    {
        return $this->set('thumbRatio', $value);
    }

    /**
     * 指定为图片上传控件
     */
    public function type($value = 'input-image')
    {
        return $this->set('type', $value);
    }

    /**
     * 上传按钮文案
     */
    public function uploadBtnText($value = '')
    {
        return $this->set('uploadBtnText', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 远端校验表单项接口
     */
    public function validateApi($value = '')
    {
        return $this->set('validateApi', $value);
    }

    /**
     * 不设置时，当表单提交过后表单项每次修改都会触发重新验证， 如果设置了，则由此配置项来决定要不要每次修改都触发验证。
     */
    public function validateOnChange($value = true)
    {
        return $this->set('validateOnChange', $value);
    }

    /**
     * 验证失败的提示信息
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
     * 默认值，切记只能是静态值，不支持取变量，跟数据关联是通过设置 name 属性来实现的。
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
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

    /**
     * 在Table中调整宽度
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }


}
