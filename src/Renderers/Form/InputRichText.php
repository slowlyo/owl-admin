<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

use Slowlyo\SlowAdmin\Traits\Uploader;

/**
 * <b>InputRichText 富文本编辑器</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-rich-text
 *
 * @method self saveAsUbb($value) 是否保存为 ubb 格式
 * @method self receiver($value) 默认的图片保存 API
 * @method self videoReceiver($value) 默认的视频保存 API
 * @method self fileField($value) 上传文件时的字段名
 * @method self size($value) 框的大小，可设置为 md 或者 lg
 * @method self options($value) 需要参考 tinymce 或 froala 的文档
 * @method self buttons($value) froala 专用，配置显示的按钮，tinymce 可以通过前面的 options 设置 toolbar 字符串
 * @method self vendor($value) 使用的富文本编辑器，可选 tinymce 或者 froala
 */
class InputRichText extends FormItem
{
    use Uploader;

    public string $type = 'input-rich-text';

    public function __construct()
    {
        $this->receiver($this->uploadRichPath());
        $this->videoReceiver($this->uploadRichPath());
        // tinymce 暂时无法使用, 等待官方修复, 默认使用 froala
        $this->vendor('froala');
    }
}
