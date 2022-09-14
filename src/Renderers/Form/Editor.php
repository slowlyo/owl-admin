<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>Editor 编辑器</b><br/>
 * https://aisuda.bce.baidu.com/amis/zh-CN/components/form/editor
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/diff-editor
 *
 * @method self language($value) 编辑器高亮的语言，支持通过 '${xxx}' 变量获取
 * @method self size($value) 编辑器高度，取值可以是 md、lg、xl、xxl
 * @method self allowFullscreen($value) 是否显示全屏模式开关
 * @method self options($value) 编辑器的其它配置，比如是否显示行号等，请参考这里，不过无法设置 readOnly，只读模式需要使用 disabled: true
 */
class Editor extends FormItem
{
    public string $type = 'editor';
}
