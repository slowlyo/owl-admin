<?php

namespace Slowlyo\OwlAdmin\Renderers;

use Slowlyo\OwlAdmin\Traits\UploadTrait;

/**
 * File 文件上传控件 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/file
 *
 * @author  slowlyo
 * @version 6.7.0
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
     * 默认只支持纯文本，要支持其他类型，请配置此属性。建议直接填写文件后缀 如：.txt,.csv多个类型用逗号隔开。
     */
    public function accept($value = '')
    {
        return $this->set('accept', $value);
    }

    /**
     * 如果上传的文件比较小可以设置此选项来简单的把文件 base64 的值给 form 一起提交，目前不支持多选。
     */
    public function asBase64($value = true)
    {
        return $this->set('asBase64', $value);
    }

    /**
     * 如果不希望 File 组件上传，可以配置 `asBlob` 或者 `asBase64`，采用这种方式后，组件不再自己上传了，而是直接把文件数据作为表单项的值，文件内容会在 Form 表单提交的接口里面一起带上。
     */
    public function asBlob($value = true)
    {
        return $this->set('asBlob', $value);
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
     * 按钮 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function btnClassName($value = '')
    {
        return $this->set('btnClassName', $value);
    }

    /**
     * 上传文件按钮说明
     */
    public function btnLabel($value = '')
    {
        return $this->set('btnLabel', $value);
    }

    /**
     * 上传按钮 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function btnUploadClassName($value = '')
    {
        return $this->set('btnUploadClassName', $value);
    }

    /**
     * 控制 input 标签的 capture 属性，用于移动端拍照或录像。
     */
    public function capture($value = '')
    {
        return $this->set('capture', $value);
    }

    /**
     * 默认 `/api/upload/chunk` 想自己存储时才需要关注。 (默认 `/api/upload/chunk` 想自己存储时才需要关注。)
     */
    public function chunkApi($value = '')
    {
        return $this->set('chunkApi', $value);
    }

    /**
     * 分块大小，默认为 5M.
     */
    public function chunkSize($value = '')
    {
        return $this->set('chunkSize', $value);
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
     * 分块上传的并发数
     */
    public function concurrency($value = '')
    {
        return $this->set('concurrency', $value);
    }

    /**
     * 分割符
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
     * 是否禁用表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     * 说明文档链接配置
     */
    public function documentLink($value = '')
    {
        return $this->set('documentLink', $value);
    }

    /**
     * 说明文档内容配置
     */
    public function documentation($value = '')
    {
        return $this->set('documentation', $value);
    }

    /**
     * 默认显示文件路径的时候会支持直接下载， 可以支持加前缀如：`http://xx.dom/filename=` ， 如果不希望这样，可以把当前配置项设置为 `false`。1.1.6 版本开始将支持变量 ${xxx} 来自己拼凑个下载地址，并且支持配置成 post. (默认显示文件路径的时候会支持直接下载， 可以支持加前缀如：`http://xx.dom/filename=` ， 如果不希望这样，可以把当前配置项设置为 `false`。1.1.6 版本开始将支持变量 ${xxx} 来自己拼凑个下载地址，并且支持配置成 post.)
     */
    public function downloadUrl($value = '')
    {
        return $this->set('downloadUrl', $value);
    }

    /**
     * 是否为拖拽上传
     */
    public function drag($value = true)
    {
        return $this->set('drag', $value);
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
     * 默认 `file`, 如果你不想自己存储，则可以忽略此属性。
     */
    public function fileField($value = '')
    {
        return $this->set('fileField', $value);
    }

    /**
     * 默认 `/api/upload/finishChunkApi` 想自己存储时才需要关注。 (默认 `/api/upload/finishChunkApi` 想自己存储时才需要关注。)
     */
    public function finishChunkApi($value = '')
    {
        return $this->set('finishChunkApi', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `data.xxx > 5`。)
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
     * 初始化时是否把其他字段同步到表单内部。
     */
    public function initAutoFill($value = true)
    {
        return $this->set('initAutoFill', $value);
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
     * 1. 单选模式：当用户选中某个选项时，选项中的 value 将被作为该表单项的值提交， 否则，整个选项对象都会作为该表单项的值提交。 2. 多选模式：选中的多个选项的 `value` 会通过 `delimiter` 连接起来， 否则直接将以数组的形式提交值。
     */
    public function joinValues($value = true)
    {
        return $this->set('joinValues', $value);
    }

    /**
     * 描述标题
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
     * 显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起 (显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起)
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
     * 接口返回的数据中，哪个用来展示文件名
     */
    public function nameField($value = '')
    {
        return $this->set('nameField', $value);
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
     * 默认 `/api/upload/file` 如果想自己存储，请设置此选项。 (默认 `/api/upload/file` 如果想自己存储，请设置此选项。)
     */
    public function receiver($value = '')
    {
        return $this->set('receiver', $value);
    }

    /**
     * 显示一个小图标, 鼠标放上去的时候显示提示内容 (显示一个小图标, 鼠标放上去的时候显示提示内容)
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
     * 表单项大小 可选值: xs | sm | md | lg | full
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
    }

    /**
     * 默认 `/api/upload/startChunk` 想自己存储时才需要关注。
     */
    public function startChunkApi($value = '')
    {
        return $this->set('startChunkApi', $value);
    }

    /**
     * 按钮状态文案配置。
     */
    public function stateTextMap($value = '')
    {
        return $this->set('stateTextMap', $value);
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
     * 是否静态展示表达式 (表达式，语法 `data.xxx > 5`。)
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
     * 模板下载地址 (模板下载地址)
     */
    public function templateUrl($value = '')
    {
        return $this->set('templateUrl', $value);
    }

    /**
     *
     */
    public function testIdBuilder($value = '')
    {
        return $this->set('testIdBuilder', $value);
    }

    /**
     * 指定为文件上传
     */
    public function type($value = 'input-file')
    {
        return $this->set('type', $value);
    }

    /**
     * 接口返回的数据中哪个用来作为下载地址。
     */
    public function urlField($value = '')
    {
        return $this->set('urlField', $value);
    }

    /**
     * 默认为 'auto' amis 所在服务器，限制了文件上传大小不得超出10M，所以 amis 在用户选择大文件的时候，自动会改成分块上传模式。
     */
    public function useChunk($value = '')
    {
        return $this->set('useChunk', $value);
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
     * 接口返回的数据中，哪个用来当做值
     */
    public function valueField($value = '')
    {
        return $this->set('valueField', $value);
    }

    /**
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式 (表达式，语法 `data.xxx > 5`。)
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
