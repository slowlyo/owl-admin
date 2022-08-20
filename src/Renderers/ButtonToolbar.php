<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Button-Toolbar 按钮工具栏</b><br/>
 * 默认按钮会独占一行，如果想让多个按钮并排方式，可以使用 button-toolbar 组件包裹起来，另外还有能用 button-group 来在展现上更紧凑。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/button-toolbar
 *
 * @method self buttons($value) 按钮组
 */
class ButtonToolbar extends BaseRenderer
{
    public string $type = 'button-toolbar';
}
