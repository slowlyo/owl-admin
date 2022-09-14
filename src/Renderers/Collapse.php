<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Collapse 折叠器</b>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/collapse
 *
 * @method self disabled($value) 禁用
 * @method self collapsed($value) 始状态是否折叠
 * @method self key($value) 标识
 * @method self header($value) 标题
 * @method self body($value) 内容
 * @method self showArrow($value) 是否展示图标
 */
class Collapse extends BaseRenderer
{
    public string $type = 'collapse';
}
