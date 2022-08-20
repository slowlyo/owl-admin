<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

use Slowlyo\SlowAdmin\Renderers\BaseRenderer;

/**
 * <b>InputFormula 公式编辑器</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-formula
 *
 * @method self title($value) 弹框标题
 * @method self header($value) 编辑器 header 标题，如果不设置，默认使用表单项label字段
 * @method self evalMode($value) 表达式模式 或者 模板模式，模板模式则需要将表达式写在 '${ }' 中间。
 * @method self variables($value) 可用变量
 * @method self variableMode($value) 可配置成 tabs 或者 tree 默认为列表，支持分组。
 * @method self functions($value) 可以不设置，默认就是 amis-formula 里面定义的函数，如果扩充了新的函数则需要指定
 * @method self inputMode($value) 控件的展示模式
 * @method self icon($value) 按钮图标，例如fa fa-list
 * @method self btnLabel($value) 按钮文本，inputMode为button时生效
 * @method self level($value) 按钮样式
 * @method self allowInput($value) 输入框是否可输入
 * @method self btnSize($value) 按钮大小
 * @method self borderMode($value) 输入框边框模式
 * @method self placeholder($value) 输入框占位符
 * @method self className($value) 控件外层 CSS 样式类名
 * @method self variableClassName($value) 变量面板 CSS 样式类名
 * @method self functionClassName($value) 函数面板 CSS 样式类名
 */
class InputFormula extends BaseRenderer
{
    public string $type = 'input-formula';
}
