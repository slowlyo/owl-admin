<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>DiffEditor 对比编辑器</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/diff-editor
 *
 * @method self anguage($value) 编辑器高亮的语言，可选 支持的语言
 * @method self diffValue($value) 左侧值
 */
class DiffEditor extends FormItem
{
    public string $type = 'diff-editor';
}
