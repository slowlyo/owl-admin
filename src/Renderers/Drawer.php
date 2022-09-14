<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Drawer 抽屉</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/drawer
 *
 * @method self title($value) 弹出层标题
 * @method self body($value) 往 Drawer 内容区加内容
 * @method self size($value) 指定 Drawer 大小，支持: xs、sm、md、lg、xl
 * @method self position($value) 指定 Drawer 方向，支持: left、right、top、bottom
 * @method self className($value) Drawer 最外层容器的样式类名
 * @method self headerClassName($value) Drawer 头部 区域的样式类名
 * @method self bodyClassName($value) Drawer body 区域的样式类名
 * @method self footerClassName($value) Drawer 页脚 区域的样式类名
 * @method self showCloseButton($value) 是否展示关闭按钮，当值为 false 时，默认开启 closeOnOutside
 * @method self closeOnEsc($value) 是否支持按 Esc 关闭 Drawer
 * @method self closeOnOutside($value) 点击内容区外是否关闭 Drawer
 * @method self overlay($value) 是否显示蒙层
 * @method self resizable($value) 是否可通过拖拽改变 Drawer 大小
 * @method self width($value) 容器的宽度，在 position 为 left 或 right 时生效
 * @method self height($value) 容器的高度，在 position 为 top 或 bottom 时生效
 * @method self actions($value) 【确认】和【取消】    可以不设置，默认只有两个按钮。
 * @method self data($value) 支持 数据映射，如果不设定将默认将触发按钮的上下文中继承数据。
 */
class Drawer extends BaseRenderer
{
    public string $type = 'drawer';
}
