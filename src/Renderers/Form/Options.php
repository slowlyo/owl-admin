<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>Options 选择器表单项</b><br/>
 * 选择器表单项 是指那些（例如下拉选择框）具有选择器特性的表单项
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/options
 *
 * @method self options($value) 选项组，供用户选择
 * @method self source($value) 选项组源，可通过数据映射获取当前数据域变量、或者配置 API 对象
 * @method self multiple($value) 是否支持多选
 * @method self labelField($value) 标识选项中哪个字段是label值
 * @method self valueField($value) 标识选项中哪个字段是value值
 * @method self joinValues($value) 是否拼接value值
 * @method self extractValue($value) 是否将value值抽取出来组成新的数组，只有在joinValues是false是生效
 * @method self itemHeight($value) 每个选项的高度，用于虚拟渲染
 * @method self virtualThreshold($value) 在选项数量超过多少时开启虚拟渲染
 * @method self valuesNoWrap($value) 默认情况下多选所有选项都会显示，通过这个可以最多显示一行，超出的部分变成 ...
 */
class Options extends FormItem
{
}
