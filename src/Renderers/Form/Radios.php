<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>Radios 单选框</b><br/>
 * 用于实现单选。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/radios
 *
 * @method self options($value) 选项组
 * @method self source($value) 动态选项组
 * @method self labelField($value) 选项标签字段
 * @method self valueField($value) 选项值字段
 * @method self columnsCount($value) 选项按几列显示，默认为一列
 * @method self inline($value) 是否显示为一行
 * @method self selectFirst($value) 是否默认选中第一个
 * @method self autoFill($value) 自动填充
 */
class Radios extends FormItem
{
    public string $type = 'radios';
}
