<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputRating 评分</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-rating
 *
 * @method self value($value) 当前值
 * @method self half($value = true) 是否使用半星选择
 * @method self count($value) 总星数
 * @method self readOnly($value = true) 只读
 * @method self allowClear($value = true) 是否允许再次点击后清除
 * @method self colors($value) 星星被选中的颜色。 若传入字符串，则只有一种颜色。若传入对象，可自定义分段，键名为分段的界限值，键值为对应的类名
 * @method self inactiveColor($value) 未被选中的星星的颜色
 * @method self texts($value) 星星被选中时的提示文字。可自定义分段，键名为分段的界限值，键值为对应的类名
 * @method self textPosition($value) 文字的位置
 * @method self char($value) 自定义字符
 * @method self className($value) 自定义样式类名
 * @method self charClassName($value) 自定义字符类名
 * @method self textClassName($value) 自定义文字类名
 */
class InputRating extends FormItem
{
    public string $type = 'input-rating';
}
