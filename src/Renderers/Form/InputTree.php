<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputTree 树形选择框</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-tree
 *
 * @method self options($value) 选项组
 * @method self source($value) 动态选项组
 * @method self autoComplete($value) 自动提示补全
 * @method self multiple($value) 是否多选
 * @method self delimiter($value) 拼接符
 * @method self labelField($value) 选项标签字段
 * @method self valueField($value) 选项值字段
 * @method self iconField($value) 图标值字段
 * @method self joinValues($value) 拼接值
 * @method self extractValue($value) 提取值
 * @method self creatable($value) 新增选项
 * @method self addControls($value) 自定义新增表单项
 * @method self addApi($value) 配置新增选项接口
 * @method self editable($value) 编辑选项
 * @method self editControls($value) 自定义编辑表单项
 * @method self editApi($value) 配置编辑选项接口
 * @method self removable($value) 删除选项
 * @method self deleteApi($value) 配置删除选项接口
 * @method self searchable($value) 是否可检索，仅在 type 为 tree-select 的时候生效
 * @method self hideRoot($value) 如果想要显示个顶级节点，请设置为 false
 * @method self rootLabel($value) 当 hideRoot 不为 false 时有用，用来设置顶级节点的文字。
 * @method self showIcon($value) 是否显示图标
 * @method self showRadio($value) 是否显示单选按钮，multiple 为 false 是有效。
 * @method self showOutline($value) 是否显示树层级展开线
 * @method self initiallyOpen($value) 设置是否默认展开所有层级。
 * @method self unfoldedLevel($value) 设置默认展开的级数，只有initiallyOpen不是true时生效。
 * @method self autoCheckChildren($value) 当选中父节点时级联选择子节点。
 * @method self cascade($value) autoCheckChildren 为 true 时生效；默认行为：子节点禁用，值只包含父节点值；设置为 true 时，子节点可反选，值包含父子节点值。
 * @method self withChildren($value) cascade 为 false 时生效，选中父节点时，值里面将包含父子节点的值，否则只会保留父节点的值。
 * @method self onlyChildren($value) autoCheckChildren 为 true 时生效，不受 cascade 影响；onlyChildren 为 true，ui 行为级联选中子节点，子节点可反选，值只包含子节点的值。
 * @method self onlyLeaf($value) 只允许选择叶子节点
 * @method self rootCreatable($value) 是否可以创建顶级节点
 * @method self rootCreateTip($value) 创建顶级节点的悬浮提示
 * @method self minLength($value) 最少选中的节点数
 * @method self maxLength($value) 最多选中的节点数
 * @method self treeContainerClassName($value) tree 最外层容器类名
 * @method self enableNodePath($value) 是否开启节点路径模式
 * @method self pathSeparator($value) 节点路径的分隔符，enableNodePath为true时生效
 * @method self highlightTxt($value) 标签中需要高亮的字符，支持变量
 */
class InputTree extends FormItem
{
    public string $type = 'input-tree';
}
