<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * <b>Breadcrumb 面包屑</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/breadcrumb
 *
 * @method self className($value) 外层类名
 * @method self itemClassName($value) 导航项类名
 * @method self separatorClassName($value) 分割符类名
 * @method self dropdownClassName($value) 下拉菜单类名
 * @method self dropdownItemClassName($value) 下拉菜单项类名
 * @method self separator($value) 分隔符
 * @method self labelMaxLength($value) 最大展示长度
 * @method self tooltipPosition($value) 浮窗提示位置
 * @method self source($value) 动态数据
 * @method self items($value) 文本
 */
class Breadcrumb extends BaseRenderer
{
    public string $type = 'breadcrumb';
}
