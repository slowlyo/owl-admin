<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self deferApi($value) 如果设置了，优先级更高，不设置走 source 接口加载。
 * @method self label($value) 用来显示的文字
 * @method self scopeLabel($value) 可以用来给 Option 标记个范围，让数据展示更清晰。这个只有在数值展示的时候显示。
 * @method self value($value) 请保证数值唯一，多个选项值一致会认为是同一个选项。
 * @method self children($value) 支持嵌套
 * @method self visible($value) 是否可见
 * @method self hidden($value) 最好不要用！因为有 visible 就够了。
 * @method self defer($value) 标记后数据延时加载
 * @method self loading($value) 标记正在加载。只有 defer 为 true 时有意义。内部字段不可以外部设置
 * @method self loaded($value) 只有设置了 defer 才有意义，内部字段不可以外部设置
 * @method self disabled($value) 是否禁用
 * @method self description($value) 描述，部分控件支持
 */
class Option extends BaseRenderer
{
}
