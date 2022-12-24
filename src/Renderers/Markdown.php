<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Markdown 渲染</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/markdown
 *
 * @method self name($value) 名称
 * @method self value($value) 静态值
 * @method self className($value) 类名
 * @method self src($value) 外部地址
 */
class Markdown extends BaseRenderer
{
    public string $type = 'markdown';
}
