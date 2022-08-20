<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Button 按钮</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/button
 * @method self className($value) 指定添加 button 类名
 * @method self url($value)    点击跳转的地址，指定此属性 button 的行为和 a 链接一致
 * @method self tooltipTrigger($value) 触发 tootip
 * @method self disabled($value) 按钮失效状态
 * @method self loading($value) 显示按钮 loading 效果
 * @method self loadingOn($value) 显示按钮 loading 表达式
 */
class Button extends Action
{
    public string $type = 'button';
}
