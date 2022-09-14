<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>Combo 组合</b><br/>
 * 用于将多个表单项组合到一起，实现深层结构的数据编辑。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/combo
 *
 * @method self formClassName($value) 单组表单项的类名
 * @method self items($value) 组合展示的表单项
 * @method self noBorder($value) 单组表单项是否显示边框
 * @method self scaffold($value) 单组表单项初始值
 * @method self multiple($value) 是否多选
 * @method self multiLine($value) 默认是横着展示一排，设置以后竖着展示
 * @method self minLength($value) 最少添加的条数
 * @method self maxLength($value) 最多添加的条数
 * @method self flat($value) 是否将结果扁平化(去掉 name), 只有当 items 的 length 为 1 且 multiple 为 true 的时候才有效。
 * @method self joinValues($value) 默认为 true 当扁平化开启的时候，是否用分隔符的形式发送给后端，否则采用 array 的方式。
 * @method self delimiter($value) 当扁平化开启并且 joinValues 为 true 时，用什么分隔符。
 * @method self addable($value) 是否可新增
 * @method self removable($value) 是否可删除
 * @method self deleteApi($value) 如果配置了，则删除前会发送一个 api，请求成功才完成删除
 * @method self deleteConfirmText($value) 当配置 deleteApi 才生效！删除时用来做用户确认
 * @method self draggable($value) 是否可以拖动排序, 需要注意的是当启用拖动排序的时候，会多一个$id 字段
 * @method self draggableTip($value) 可拖拽的提示文字
 * @method self subFormMode($value) 可选normal、horizontal、inline
 * @method self placeholder($value) 没有成员时显示。
 * @method self canAccessSuperData($value) 指定是否可以自动获取上层的数据并映射到表单项上
 * @method self conditions($value) 数组的形式包含所有条件的渲染类型，单个数组内的test 为判断条件，数组内的items为符合该条件后渲染的schema
 * @method self typeSwitchable($value) 是否可切换条件，配合conditions使用
 * @method self strictMode($value) 默认为严格模式，设置为 false 时，当其他表单项更新是，里面的表单项也可以及时获取，否则不会。
 * @method self syncFields($value) 配置同步字段。只有 strictMode 为 false 时有效。如果 Combo 层级比较深，底层的获取外层的数据可能不同步。但是给 combo 配置这个属性就能同步下来。输入格式：["os"]
 * @method self nullable($value) 允许为空，如果子表单项里面配置验证器，且又是单条模式。可以允许用户选择清空（不填）。
 * @method self itemClassName($value) 单组 CSS 类
 * @method self itemsWrapperClassName($value) 组合区域 CSS 类
 * @method self deleteBtn($value) 自定义删除按钮    只有当removable为 true 时有效 如果为string则为按钮的文本；如果为Button则根据配置渲染删除按钮。
 * @method self addBtn($value) 自定义新增按钮    可新增自定义配置渲染新增按钮，在tabsMode: true下不生效。
 * @method self addButtonClassName($value) 新增按钮 CSS 类名
 * @method self addButtonText($value) 新增按钮文字
 */
class Combo extends FormItem
{
    public string $type = 'combo';
}
