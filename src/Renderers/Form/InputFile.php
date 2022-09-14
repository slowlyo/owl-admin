<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputFile 文件上传</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-file
 *
 *
 * @method self receiver($value) 上传文件接口
 * @method self accept($value) 默认只支持纯文本，要支持其他类型，请配置此属性为文件后缀.xxx
 * @method self asBase64($value) 将文件以base64的形式，赋值给当前组件
 * @method self asBlob($value) 将文件以二进制的形式，赋值给当前组件
 * @method self maxSize($value) 默认没有限制，当设置后，文件大小大于此值将不允许上传。单位为B
 * @method self maxLength($value) 默认没有限制，当设置后，一次只允许上传指定数量文件。
 * @method self multiple($value) 是否多选。
 * @method self drag($value) 是否为拖拽上传
 * @method self joinValues($value) 拼接值
 * @method self extractValue($value) 提取值
 * @method self delimiter($value) 拼接符
 * @method self autoUpload($value) 否选择完就自动开始上传
 * @method self hideUploadButton($value) 隐藏上传按钮
 * @method self stateTextMap($value) 上传状态文案
 * @method self fileField($value) 如果你不想自己存储，则可以忽略此属性。
 * @method self nameField($value) 接口返回哪个字段用来标识文件名
 * @method self valueField($value) 文件的值用那个字段来标识。
 * @method self urlField($value) 文件下载地址的字段名。
 * @method self btnLabel($value) 上传按钮的文字
 * @method self downloadUrl($value) 1.1.6 版本开始支持 post:http://xxx.com/${value} 这种写法	默认显示文件路径的时候会支持直接下载，可以支持加前缀如：http://xx.dom/filename= ，如果不希望这样，可以把当前配置项设置为 false。
 * @method self useChunk($value) amis 所在服务器，限制了文件上传大小不得超出 10M，所以 amis 在用户选择大文件的时候，自动会改成分块上传模式。
 * @method self chunkSize($value) 分块大小
 * @method self startChunkApi($value) startChunkApi
 * @method self chunkApi($value) chunkApi
 * @method self finishChunkApi($value) finishChunkApi
 * @method self concurrency($value) 分块上传时并行个数
 * @method self documentation($value) 文档内容
 * @method self documentLink($value) 文档链接
 * @method self initAutoFill($value) 初表单反显时是否执行
 */
class InputFile extends FormItem
{
    public string $type = 'input-file';
}
