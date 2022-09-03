<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

use Slowlyo\SlowAdmin\Renderers\BaseRenderer;

/**
 * <b>FormItem 普通表单项</b><br/>
 * 表单项 是组成一个表单的基本单位，它具有的一些特性会帮助我们更好地实现表单操作。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/formitem
 *
 * @method self type($value) 指定表单项类型
 * @method self className($value) 表单最外层类名
 * @method self inputClassName($value) 表单控制器类名
 * @method self labelClassName($value) label 的类名
 * @method self name($value) 字段名，指定该表单项提交时的 key
 * @method self value($value) 表单默认值
 * @method self label($value) 表单项标签
 * @method self labelAlign($value) 表单项标签对齐方式，默认右对齐，仅在 mode为horizontal 时生效
 * @method self labelRemark($value) 表单项标签描述
 * @method self description($value) 表单项描述
 * @method self placeholder($value) 表单项描述
 * @method self inline($value = true) 是否为 内联 模式
 * @method self submitOnChange($value = true) 是否该表单项值发生变化时就提交当前表单。
 * @method self disabled($value = true) 当前表单项是否是禁用状态
 * @method self disabledOn($value) 当前表单项是否禁用的条件
 * @method self visible($value) 当前表单项是否禁用的条件
 * @method self visibleOn($value) 当前表单项是否禁用的条件
 * @method self required($value = true) 是否为必填。
 * @method self requiredOn($value) 通过表达式来配置当前表单项是否为必填。
 * @method self validations($value) 表单项值格式验证，支持设置多个，多个规则用英文逗号隔开。
 * @method self validateApi($value) 表单校验接口
 * @method self autoFill($value) 数据录入配置，自动填充或者参照录入
 */
class FormItem extends BaseRenderer
{
}
