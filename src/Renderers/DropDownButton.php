<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>DropDownButton 下拉按钮</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/dropdown-button
 *
 * @method self label($value) 按钮文本
 * @method self className($value) 外层 CSS 类名
 * @method self btnClassName($value) 按钮 CSS 类名
 * @method self menuClassName($value) 下拉菜单 CSS 类名
 * @method self block($value) 块状样式
 * @method self size($value) 尺寸，支持'xs'、'sm'、'md' 、'lg'
 * @method self align($value) 位置，可选'left'或'right'
 * @method self buttons($value) 配置下拉按钮
 * @method self iconOnly($value = true) 只显示 icon
 * @method self defaultIsOpened($value = true) 默认是否打开
 * @method self closeOnOutside($value = true) 点击外侧区域是否收起
 * @method self closeOnClick($value = true) 点击按钮后自动关闭下拉菜单
 * @method self trigger($value) 触发方式 (click/hover)
 * @method self hideCaret($value = true) 隐藏下拉图标
 */
class DropDownButton extends BaseRenderer
{
    public string $type = 'dropdown-button';
}
