<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>NestedSelect 级联选择器</b><br/>
 * 矩阵类型的输入框。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/nestedselect
 *
 * @method self options($value) 选项组
 * @method self source($value) 动态选项组
 * @method self delimiter($value) 拼接符
 * @method self labelField($value) 选项标签字段
 * @method self valueField($value) 选项值字段
 * @method self joinValues($value) 拼接值
 * @method self extractValue($value) 提取值
 * @method self autoFill($value) 自动填充
 * @method self cascade($value) 设置 true时，当选中父节点时不自动选择子节点。
 * @method self withChildren($value) 设置 true时，选中父节点时，值里面将包含子节点的值，否则只会保留父节点的值。
 * @method self onlyChildren($value) 多选时，选中父节点时，是否只将其子节点加入到值中。
 * @method self searchable($value) 可否搜索
 * @method self searchPromptText($value) 搜索框占位文本
 * @method self noResultsText($value) 无结果时的文本
 * @method self multiple($value) 可否多选
 * @method self hideNodePathLabel($value) 是否隐藏选择框中已选择节点的路径 label 信息
 * @method self onlyLeaf($value) 只允许选择叶子节点
 */
class NestedSelect extends FormItem
{
    public string $type = 'nested-select';
}
