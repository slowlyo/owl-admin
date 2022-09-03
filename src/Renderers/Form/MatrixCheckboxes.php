<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>MatrixCheckboxes 矩阵</b><br/>
 * 矩阵类型的输入框。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/matrix-checkboxes
 *
 * @method self columns($value) 列信息，数组中 label 字段是必须给出的
 * @method self rows($value) 行信息， 数组中 label 字段是必须给出的
 * @method self rowLabel($value) 行标题说明
 * @method self source($value) Api 地址，如果选项组不固定，可以通过配置 source 动态拉取。
 * @method self multiple($value = true) 是否多选
 * @method self singleSelectMode($value) 设置单选模式，multiple为false时有效，可设置为cell, row, column 分别为全部选项中只能单选某个单元格、每行只能单选某个单元格，每列只能单选某个单元格
 */
class MatrixCheckboxes extends FormItem
{
    public string $type = 'matrix-checkboxes';
}
