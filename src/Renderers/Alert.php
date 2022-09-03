<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Alert 提示</b><br/>
 * 用来做文字特殊提示，分为四类：提示类、成功类、警告类和危险类。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/alert
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self level($value) 级别，可以是：info、success、warning 或者 danger
 * @method self body($value) 显示内容
 * @method self showCloseButton($value = true) 是否显示关闭按钮
 * @method self closeButtonClassName($value) 关闭按钮的 CSS 类名
 * @method self showIcon($value = true) 是否显示 icon
 * @method self icon($value) 自定义 icon
 * @method self iconClassName($value) icon 的 CSS 类名
 */
class Alert extends BaseRenderer
{
    public string $type = 'alert';
}
