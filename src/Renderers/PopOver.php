<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>PopOver 弹出提示</b><br/>
 * popover 不是一个独立组件，它是嵌入到其它组件中使用的，目前可以在以下组件中配置<br/>
 * table 的 column<br/>
 * list 的 column<br/>
 * static<br/>
 * cards 里的字段<br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/popover
 *
 */
class PopOver extends BaseRenderer
{
    public string $type = 'wrapper';
}
