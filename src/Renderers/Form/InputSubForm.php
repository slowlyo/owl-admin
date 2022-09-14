<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputSubForm 子表单</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-sub-form
 *
 * @method self multiple($value) 是否为多选模式
 * @method self labelField($value) 当值中存在这个字段，则按钮名称将使用此字段的值来展示。
 * @method self btnLabel($value) 按钮默认名称
 * @method self minLength($value) 限制最小个数。
 * @method self maxLength($value) 限制最大个数。
 * @method self draggable($value) 是否可拖拽排序
 * @method self addable($value) 是否可新增
 * @method self removable($value) 是否可删除
 * @method self addButtonClassName($value) 新增按钮 CSS 类名
 * @method self itemClassName($value) 值元素 CSS 类名
 * @method self itemsClassName($value) 值包裹元素 CSS 类名
 * @method self form($value) 子表单配置，同 Form
 * @method self addButtonText($value) 自定义新增一项的文本
 * @method self showErrorMsg($value) 是否在左下角显示报错信息
 */
class InputSubForm extends FormItem
{
    public string $type = 'input-sub-form';
}
