<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputRange 滑块</b><br/>
 * 可以用于选择单个数值或数值范围。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-range
 *
 * @method self className($value) css 类名
 * @method self value($value)
 * @method self min($value) 最小值
 * @method self max($value) 最大值
 * @method self disabled($value) 是否禁用
 * @method self step($value) 步长
 * @method self showSteps($value) 是否显示步长
 * @method self parts($value) 分割的块数 主持数组传入分块的节点
 * @method self marks($value) 刻度标记
 * @method self tooltipVisible($value) 是否显示滑块标签
 * @method self tooltipPlacement($value) 滑块标签的位置，默认auto，方向自适应 前置条件：tooltipVisible 不为 false 时有效
 * @method self tipFormatter($value) 控制滑块标签显隐函数 前置条件：tooltipVisible 不为 false 时有效
 * @method self multiple($value) 支持选择范围
 * @method self joinValues($value) 默认为 true，选择的 value 会通过 delimiter 连接起来，否则直接将以'{min: 1, max: 100}'的形式提交 前置条件：开启multiple时有效
 * @method self delimiter($value) 分隔符
 * @method self unit($value) 单位
 * @method self clearable($value) 是否可清除 前置条件：开启showInput时有效
 * @method self showInput($value) 是否显示输入框
 * @method self onChange($value) 当 组件 的值发生改变时，会触发 onChange 事件，并把改变后的值作为参数传入
 * @method self onAfterChange($value) 与 onmouseup 触发时机一致，把当前值作为参数传入
 */
class InputRange extends FormItem
{
    public string $type = 'input-range';
}
