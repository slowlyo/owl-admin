<?php

namespace Slowlyo\SlowAdmin\Renderers;

use Slowlyo\SlowAdmin\Traits\Uploader;

/**
 * Image 图片上传控件 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/image
 *
 * @method self labelWidth($value) label自定义宽度，默认单位为px
 * @method self descriptionClassName($value) 配置描述上的 className
 * @method self autoUpload($value) 是否自动开始上传
 * @method self hideUploadButton($value) 是否隐藏上传按钮
 * @method self name($value) 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
 * @method self validationErrors($value) 验证失败的提示信息
 * @method self accept($value) 配置接收的图片类型建议直接填写文件后缀 如：.txt,.csv多个类型用逗号隔开。
 * @method self btnClassName($value) 选择图片按钮的 CSS 类名
 * @method self resetValue($value) 清除时设置的值
 * @method self fixedSize($value) 是否开启固定尺寸
 * @method self className($value) 容器 css 类名
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self size($value) 表单项大小 可选值: xs | sm | md | lg | full | 
 * @method self readOnly($value) 是否只读
 * @method self limit($value) 限制图片大小，超出不让上传。
 * @method self frameImage($value) 默认占位图图片地址
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self compressOptions($value) 
 * @method self thumbMode($value) 缩路图展示模式 可选值: w-full | h-full | contain | cover | 
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self label($value) 描述标题
 * @method self submitOnChange($value) 当修改完的时候是否提交表单。
 * @method self desc($value) 
 * @method self cropFormat($value) 裁剪后的图片类型
 * @method self multiple($value) 是否为多选
 * @method self required($value) 是否为必填
 * @method self receiver($value) 默认 `/api/upload` 如果想自己存储，请设置此选项。
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticSchema($value) 
 * @method self hint($value) 输入提示，聚焦的时候显示
 * @method self horizontal($value) 当配置为水平布局的时候，用来配置具体的左右分配。
 * @method self inputClassName($value) 配置 input className
 * @method self placeholder($value) 占位符
 * @method self labelAlign($value) 描述标题
 * @method self validateOnChange($value) 不设置时，当表单提交过后表单项每次修改都会触发重新验证， 如果设置了，则由此配置项来决定要不要每次修改都触发验证。
 * @method self cropQuality($value) 裁剪后的质量
 * @method self showCompressOptions($value) 默认为 false, 开启后，允许用户输入压缩选项。
 * @method self initAutoFill($value) 初始化时是否把其他字段同步到表单内部。
 * @method self value($value) 默认值，切记只能是静态值，不支持取变量，跟数据关联是通过设置 name 属性来实现的。
 * @method self compress($value) 
 * @method self joinValues($value) 单选模式：当用户选中某个选项时，选项中的 value 将被作为该表单项的值提交，否则，整个选项对象都会作为该表单项的值提交。 多选模式：选中的多个选项的 `value` 会通过 `delimiter` 连接起来，否则直接将以数组的形式提交值。
 * @method self inline($value) 表单 control 是否为 inline 模式。
 * @method self clearValueOnHidden($value) 表单项隐藏时，是否在当前 Form 中删除掉该表单项值。注意同名的未隐藏的表单项值也会删掉
 * @method self visible($value) 是否显示
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self labelRemark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起
 * @method self readOnlyOn($value) 只读条件
 * @method self description($value) 描述内容，支持 Html 片段。
 * @method self static($value) 是否静态展示
 * @method self remark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容
 * @method self validations($value) 
 * @method self maxSize($value) 默认没有限制，当设置后，文件大小大于此值将不允许上传。
 * @method self dropCrop($value) 图片上传完毕是否进入裁剪模式
 * @method self type($value) 指定为图片上传控件
 * @method self btnUploadClassName($value) 上传按钮的 CSS 类名
 * @method self thumbRatio($value) 缩路图展示比率。 可选值: 1:1 | 4:3 | 16:9 | 
 * @method self initCrop($value) 初始化时是否打开裁剪模式
 * @method self width($value) 在Table中调整宽度
 * @method self disabled($value) 是否禁用
 * @method self mode($value) 配置当前表单项展示模式 可选值: normal | inline | horizontal | 
 * @method self src($value) 默认展示图片的链接
 * @method self allowInput($value) 默认都是通过用户选择图片后上传返回图片地址，如果开启此选项，则可以允许用户图片地址。
 * @method self crop($value) 
 * @method self hidden($value) 是否隐藏
 * @method self visibleOn($value) 是否显示表达式
 * @method self labelClassName($value) 配置 label className
 * @method self autoFill($value) 上传后把其他字段同步到表单内部。
 * @method self onEvent($value) 事件动作配置
 * @method self imageClassName($value) 默认展示图片的类名
 * @method self extractValue($value) 开启后将选中的选项 value 的值封装为数组，作为当前表单项的值。
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self validateApi($value) 远端校验表单项接口
 * @method self reCropable($value) 是否允许二次裁剪。
 * @method self maxLength($value) 最多的个数
 * @method self delimiter($value) 分割符
 * @method self fixedSizeClassName($value) 固定尺寸的 CSS类名
 */
class ImageControl extends BaseRenderer
{

	use Uploader;

    public string $type = 'input-image';

    public function __construct()
    {
        $this->receiver($this->uploadImagePath());
    }
}
