<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Toast 轻提示</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/toast
 *
 * @method self title($value) 弹出层标题
 * @method self items($value) 轻提示内容
 * @method self position($value) 提示显示位置，可用'top-right'、'top-center'、'top-left'、'bottom-center'、'bottom-left'、'bottom-right'、'center'
 * @method self closeButton($value) 是否展示关闭按钮，移动端不展示
 * @method self showIcon($value) 是否展示图标
 * @method self timeout($value) 持续时间
 */
class Toast extends BaseRenderer
{
    public string $type = 'toast';
}
