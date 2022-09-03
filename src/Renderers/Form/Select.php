<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>Select 选择器</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/select
 *
 * @method self options($value) 选项组
 * @method self source($value) 动态选项组
 * @method self autoComplete($value) 自动提示补全
 * @method self delimiter($value) 拼接符
 * @method self labelField($value) 选项标签字段
 * @method self valueField($value) 选项值字段
 * @method self joinValues($value = true) 拼接值
 * @method self extractValue($value = true) 提取值
 * @method self checkAll($value = true) 是否支持全选
 * @method self checkAllLabel($value) 全选的文字
 * @method self checkAllBySearch($value) 有检索时只全选检索命中的项
 * @method self defaultCheckAll($value = true) 默认是否全选
 * @method self creatable($value = true) 新增选项
 * @method self multiple($value = true) 多选
 * @method self searchable($value = true) 检索
 * @method self createBtnLabel($value) 新增选项
 * @method self addControls($value) 自定义新增表单项
 * @method self addApi($value) 配置新增选项接口
 * @method self editable($value = true) 编辑选项
 * @method self editControls($value) 自定义编辑表单项
 * @method self editApi($value) 配置编辑选项接口
 * @method self removable($value = true) 删除选项
 * @method self deleteApi($value) 配置删除选项接口
 * @method self autoFill($value) 自动填充
 * @method self menuTpl($value) 支持配置自定义菜单
 * @method self clearable($value = true) 单选模式下是否支持清空
 * @method self hideSelected($value = true) 隐藏已选选项
 * @method self mobileClassName($value) 移动端浮层类名
 * @method self selectMode($value) 可选：group、table、tree、chained、associated。分别为：列表形式、表格形式、树形选择形式、级联选择形式，关联选择形式（与级联选择的区别在于，级联是无限极，而关联只有一级，关联左边可以是个 tree）。
 * @method self searchResultMode($value) 如果不设置将采用 selectMode 的值，可以单独配置，参考 selectMode，决定搜索结果的展示形式。
 * @method self columns($value) 当展示形式为 table 可以用来配置展示哪些列，跟 table 中的 columns 配置相似，只是只有展示功能。
 * @method self leftOptions($value) 当展示形式为 associated 时用来配置左边的选项集。
 * @method self leftMode($value) 当展示形式为 associated 时用来配置左边的选择形式，支持 list 或者 tree。默认为 list。
 * @method self rightMode($value) 当展示形式为 associated 时用来配置右边的选择形式，可选：list、table、tree、chained。
 * @method self maxTagCount($value) 标签的最大展示数量，超出数量后以收纳浮层的方式展示，仅在多选模式开启后生效
 * @method self overflowTagPopover($value) 收纳浮层的配置属性，详细配置参考Tooltip
 * @method self optionClassName($value) 选项 CSS 类名
 * @method self popOverContainerSelector($value) 弹层挂载位置选择器，会通过querySelector获取
 */
class Select extends FormItem
{
    public string $type = 'select';
}
