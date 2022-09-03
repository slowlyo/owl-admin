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
 * @method self mode($value) 可配置成 popOver、dialog 或者 drawer。 默认为 popOver
 * @method self size($value) 当配置成 dialog 或者 drawer 的时候有用
 * @method self position($value) 配置弹出位置，只有 popOver 模式有用，默认是自适应
 * @method self offset($value) 默认 '{top: 0, left: 0}，如果要来一定的偏移请设置这个
 * @method self trigger($value) 触发弹出的条件。可配置为 click 或者 hover。默认为 click
 * @method self showIcon ($value = true) 是否显示图标。默认会有个放大形状的图标出现在列里面。如果配置成 false，则触发事件出现在列上就会触发弹出
 * @method self title ($value)
 * @method self body ($value)
 */
class PopOver extends BaseRenderer
{
}
