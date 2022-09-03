<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>CollapseGroup 折叠器组</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/collapse
 *
 * @method self activeKey($value) 初始化激活面板的key
 * @method self accordion($value = true) 手风琴模式
 * @method self expandIcon($value) 自定义切换图标
 * @method self expandIconPosition($value = 'left') 设置图标位置，可选值left | right
 * @method self body($value) 子元素, 数组表示多个
 */
class CollapseGroup extends BaseRenderer
{
    public string $type = 'collapse-group';
}
