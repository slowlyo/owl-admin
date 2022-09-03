<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputArray 数组输入框</b><br/>
 * InputArray 是一种简化的 Combo，用于输入多个某种类型的表单项，提交的时将以数组的形式提交。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-array
 *
 * @method self items($value) 配置单项表单类型
 * @method self addable($value = true) 是否可新增。
 * @method self removable($value = true) 是否可删除
 * @method self draggable($value = true) 是否可以拖动排序, 需要注意的是当启用拖动排序的时候，会多一个$id 字段
 * @method self draggableTip($value) 可拖拽的提示文字，默认为："可通过拖动每行中的【交换】按钮进行顺序调整"
 * @method self addButtonText($value) 新增按钮文字
 * @method self minLength($value) 限制最小长度
 * @method self maxLength($value) 限制最大长度
 */
class InputArray extends FormItem
{
    public string $type = 'array';
}
