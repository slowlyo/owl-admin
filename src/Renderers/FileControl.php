<?php

namespace Slowlyo\OwlAdmin\Renderers;

use Slowlyo\OwlAdmin\Traits\Uploader;

/**
 * File 文件上传控件 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/file
 *
 * @method self autoUpload($value) 是否自动开始上传
 * @method self urlField($value) 接口返回的数据中哪个用来作为下载地址。
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self hint($value) 输入提示，聚焦的时候显示
 * @method self mode($value) 配置当前表单项展示模式 可选值: normal | inline | horizontal | 
 * @method self readOnly($value) 是否只读
 * @method self useChunk($value) 默认为 'auto' amis 所在服务器，限制了文件上传大小不得超出10M，所以 amis 在用户选择大文件的时候，自动会改成分块上传模式。
 * @method self extractValue($value) 开启后将选中的选项 value 的值封装为数组，作为当前表单项的值。
 * @method self resetValue($value) 清除时设置的值
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self staticSchema($value) 
 * @method self labelRemark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起
 * @method self receiver($value) 默认 `/api/upload/file` 如果想自己存储，请设置此选项。
 * @method self btnClassName($value) 按钮 CSS 类名
 * @method self joinValues($value) 1. 单选模式：当用户选中某个选项时，选项中的 value 将被作为该表单项的值提交， 否则，整个选项对象都会作为该表单项的值提交。 2. 多选模式：选中的多个选项的 `value` 会通过 `delimiter` 连接起来， 否则直接将以数组的形式提交值。
 * @method self validateOnChange($value) 不设置时，当表单提交过后表单项每次修改都会触发重新验证， 如果设置了，则由此配置项来决定要不要每次修改都触发验证。
 * @method self horizontal($value) 当配置为水平布局的时候，用来配置具体的左右分配。
 * @method self inputClassName($value) 配置 input className
 * @method self clearValueOnHidden($value) 表单项隐藏时，是否在当前 Form 中删除掉该表单项值。注意同名的未隐藏的表单项值也会删掉
 * @method self name($value) 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
 * @method self hideUploadButton($value) 是否隐藏上传按钮
 * @method self startChunkApi($value) 默认 `/api/upload/startChunk` 想自己存储时才需要关注。
 * @method self btnUploadClassName($value) 上传按钮 CSS 类名
 * @method self static($value) 是否静态展示
 * @method self validateApi($value) 远端校验表单项接口
 * @method self downloadUrl($value) 默认显示文件路径的时候会支持直接下载， 可以支持加前缀如：`http://xx.dom/filename=` ， 如果不希望这样，可以把当前配置项设置为 `false`。1.1.6 版本开始将支持变量 ${xxx} 来自己拼凑个下载地址，并且支持配置成 post.
 * @method self hidden($value) 是否隐藏
 * @method self onEvent($value) 事件动作配置
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self description($value) 描述内容，支持 Html 片段。
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self labelWidth($value) label自定义宽度，默认单位为px
 * @method self accept($value) 默认只支持纯文本，要支持其他类型，请配置此属性。建议直接填写文件后缀 如：.txt,.csv多个类型用逗号隔开。
 * @method self maxSize($value) 默认没有限制，当设置后，文件大小大于此值将不允许上传。
 * @method self visibleOn($value) 是否显示表达式
 * @method self label($value) 描述标题
 * @method self labelAlign($value) 描述标题
 * @method self type($value) 指定为文件上传
 * @method self autoFill($value) 上传后把其他字段同步到表单内部。
 * @method self validationErrors($value) 验证失败的提示信息
 * @method self validations($value) 
 * @method self btnLabel($value) 上传文件按钮说明
 * @method self delimiter($value) 分割符
 * @method self documentation($value) 说明文档内容配置
 * @method self width($value) 在Table中调整宽度
 * @method self className($value) 容器 css 类名
 * @method self labelClassName($value) 配置 label className
 * @method self inline($value) 表单 control 是否为 inline 模式。
 * @method self templateUrl($value) 模板下载地址
 * @method self visible($value) 是否显示
 * @method self placeholder($value) 占位符
 * @method self required($value) 是否为必填
 * @method self asBlob($value) 如果不希望 File 组件上传，可以配置 `asBlob` 或者 `asBase64`，采用这种方式后，组件不再自己上传了，而是直接把文件数据作为表单项的值，文件内容会在 Form 表单提交的接口里面一起带上。
 * @method self disabled($value) 是否禁用
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self descriptionClassName($value) 配置描述上的 className
 * @method self multiple($value) 是否为多选
 * @method self valueField($value) 接口返回的数据中，哪个用来当做值
 * @method self nameField($value) 接口返回的数据中，哪个用来展示文件名
 * @method self desc($value) 
 * @method self chunkApi($value) 默认 `/api/upload/chunk` 想自己存储时才需要关注。
 * @method self chunkSize($value) 分块大小，默认为 5M.
 * @method self maxLength($value) 最多的个数
 * @method self concurrency($value) 分块上传的并发数
 * @method self size($value) 表单项大小 可选值: xs | sm | md | lg | full | 
 * @method self value($value) 默认值，切记只能是静态值，不支持取变量，跟数据关联是通过设置 name 属性来实现的。
 * @method self asBase64($value) 如果上传的文件比较小可以设置此选项来简单的把文件 base64 的值给 form 一起提交，目前不支持多选。
 * @method self fileField($value) 默认 `file`, 如果你不想自己存储，则可以忽略此属性。
 * @method self finishChunkApi($value) 默认 `/api/upload/finishChunkApi` 想自己存储时才需要关注。
 * @method self initAutoFill($value) 初始化时是否把其他字段同步到表单内部。
 * @method self stateTextMap($value) 按钮状态文案配置。
 * @method self disabledOn($value) 是否禁用表达式
 * @method self remark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容
 * @method self submitOnChange($value) 当修改完的时候是否提交表单。
 * @method self readOnlyOn($value) 只读条件
 * @method self documentLink($value) 说明文档链接配置
 * @method self drag($value) 是否为拖拽上传
 */
class FileControl extends BaseRenderer
{

	use Uploader;

    public string $type = 'input-file';

    public function __construct()
    {
        $this->receiver($this->uploadFilePath());
    }
}
