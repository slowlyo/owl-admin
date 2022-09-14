<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Code 代码高亮</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/code
 *
 * @method self className($value) 外层 CSS 类名
 * @method self value($value) 显示的颜色值
 * @method self name($value) 在其他组件中，时，用作变量映射
 * @method self language($value) 所使用的高亮语言，默认是 plaintext
 * @method self tabSize($value) 默认 tab 大小
 * @method self editorTheme($value) 主题，还有 'vs-dark'
 * @method self wordWrap($value) 是否折行
 */
class Code extends BaseRenderer
{
    public string $type = 'code';
}
