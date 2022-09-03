<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>ListSelect 列表</b><br/>
 * ListSelect 一般用来实现选择，可以单选也可以多选，和 Radio/Checkboxs 最大的不同是在展现方面支持带图片。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/list-select
 *
 * @method self options($value) 选项组
 * @method self source($value) 动态选项组
 * @method self multiple($value = true) 多选
 * @method self labelField($value) 选项标签字段
 * @method self valueField($value) 选项值字段
 * @method self joinValues($value = true) 拼接值
 * @method self extractValue($value = true) 提取值
 * @method self autoFill($value) 自动填充
 * @method self listClassName($value) 支持配置 list div 的 css 类名。比如: flex justify-between
 */
class ListSelect extends FormItem
{
    public string $type = 'list-select';
}
