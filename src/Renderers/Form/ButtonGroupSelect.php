<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

use Slowlyo\SlowAdmin\Renderers\BaseRenderer;

/**
 * <b>Button-Group-Select 按钮点选</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/button-group-select
 *
 * @method self vertical($value) 是否使用垂直模式
 * @method self tiled($value) 是否使用平铺模式
 * @method self btnLevel($value) 按钮样式
 * @method self btnActiveLevel($value) 选中按钮样式
 * @method self options($value) 选项组
 * @method self source($value) 动态选项组
 * @method self multiple($value) 多选
 * @method self labelField($value) 选项标签字段
 * @method self valueField($value) 选项值字段
 * @method self joinValues($value) 拼接值
 * @method self extractValue($value) 提取值
 * @method self autoFill($value) 自动填充
 */
class ButtonGroupSelect extends FormItem
{
    public string $type = 'button-group-select';
}
