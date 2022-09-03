<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputText 输入框</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-text
 *
 * @method self options($value) 选项组
 * @method self source($value) 动态选项组
 * @method self autoComplete($value) 自动补全
 * @method self multiple($value = true) 是否多选
 * @method self delimiter($value) 拼接符
 * @method self labelField($value) 选项标签字段
 * @method self valueField($value) 选项值字段
 * @method self joinValues($value = true) 拼接值
 * @method self extractValue($value = true) 提取值
 * @method self addOn($value) 输入框附加组件，比如附带一个提示文字，或者附带一个提交按钮。
 * @method self trimContents($value) 是否去除首尾空白文本。
 * @method self creatable($value = true) 是否可以创建，默认为可以，除非设置为 false 即只能选择选项中的值
 * @method self clearable($value = true) 是否可清除
 * @method self resetValue($value) 清除后设置此配置项给定的值。
 * @method self prefix($value) 前缀
 * @method self suffix($value) 后缀
 * @method self showCounter($value = true) 是否显示计数器
 * @method self minLength($value) 限制最小字数
 * @method self maxLength($value) 限制最大字数
 * @method self transform($value) 自动转换值，可选 transform: '{ lowerCase: true, upperCase: true }'
 * @method self borderMode($value) 输入框边框模式，全边框，还是半边框，或者没边框。
 * @method self inputControlClassName($value) control 节点的 CSS 类名
 * @method self nativeInputClassName($value) 原生 input 标签的 CSS 类名
 */
class InputText extends FormItem
{
    public string $type = 'input-text';
}
