<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputImage 图片</b><br/>
 * 图片格式输入，需要实现接收器，提交时将以 url 的方式提交，如果需要以表单方式提交请使用 InputFile。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-image?page=1
 *
 * @method self receiver($value) 上传文件接口
 * @method self accept($value) 支持的图片类型格式，请配置此属性为图片后缀，例如.jpg, .png
 * @method self maxSize($value) 默认没有限制，当设置后，文件大小大于此值将不允许上传。单位为B
 * @method self maxLength($value) 默认没有限制，当设置后，一次只允许上传指定数量文件。
 * @method self multiple($value) 是否多选。
 * @method self joinValues($value) 拼接值
 * @method self extractValue($value) 提取值
 * @method self delimiter($value) 拼接符
 * @method self autoUpload($value) 否选择完就自动开始上传
 * @method self hideUploadButton($value) 隐藏上传按钮
 * @method self fileField($value) 如果你不想自己存储，则可以忽略此属性。
 * @method self crop($value) 用来设置是否支持裁剪。
 * @method self cropFormat($value) 裁剪文件格式
 * @method self cropQuality($value) 裁剪文件格式的质量，用于 jpeg/webp，取值在 0 和 1 之间
 * @method self limit($value) 限制图片大小，超出不让上传。
 * @method self frameImage($value) 默认占位图地址
 * @method self fixedSize($value) 是否开启固定尺寸, 若开启，需同时设置 fixedSizeClassName
 * @method self fixedSizeClassName($value) 开启固定尺寸时，根据此值控制展示尺寸。例如h-30, 即图片框高为 h-30, AMIS 将自动缩放比率设置默认图所占位置的宽度，最终上传图片根据此尺寸对应缩放。
 * @method self initAutoFill($value) 表单反显时是否执行 autoFill
 */
class InputImage extends FormItem
{
    public string $type = 'input-image';
}
