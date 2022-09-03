<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>Checkboxes 复选框</b><br/>
 * 用于实现多选。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/checkboxes
 *
 * @method self options($value) 选项组
 * @method self source($value) 动态选项组
 * @method self delimiter($value) 拼接符
 * @method self labelField($value) 选项标签字段
 * @method self valueField($value) 选项值字段
 * @method self joinValues($value = true) 拼接值
 * @method self extractValue($value = true) 提取值
 * @method self columnsCount($value) 选项按几列显示，默认为一列
 * @method self menuTpl($value) 支持自定义选项渲染
 * @method self checkAll($value = true) 是否支持全选
 * @method self inline($value = true) 是否显示为一行
 * @method self defaultCheckAll($value = true) 默认是否全选
 * @method self creatable($value = true) 新增选项
 * @method self createBtnLabel($value) 新增选项
 * @method self addControls($value) 自定义新增表单项
 * @method self addApi($value) 配置新增选项接口
 * @method self editable($value = true) 编辑选项
 * @method self editControls($value) 自定义编辑表单项
 * @method self editApi($value) 配置编辑选项接口
 * @method self removable($value = true) 删除选项
 * @method self deleteApi($value) 配置删除选项接口
 */
class Checkboxes extends FormItem
{
    public string $type = 'checkboxes';
}
