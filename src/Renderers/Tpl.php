<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Tpl 模板</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/tpl
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self tpl($value) 配置模板
 * @method self showNativeTitle($value) 是否设置外层 DOM 节点的 title 属性为文本内容
 */
class Tpl extends BaseRenderer
{
    public string $type = 'tpl';
}
