<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * QuarterRange 季度范围控件 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-quarter-range
 *
 * @method self labelWidth($value) label自定义宽度，默认单位为px
 * @method self submitOnChange($value) 当修改完的时候是否提交表单。
 * @method self minDuration($value) 最小跨度，比如 2days
 * @method self required($value) 是否为必填
 * @method self minDate($value) 最小日期限制，支持变量 $xxx 来取值，或者用相对值如：* `-2mins` 2分钟前\n * `+2days` 2天后\n* `-10week` 十周前\n可用单位： `min`、`hour`、`day`、`week`、`month`、`year`。所有单位支持复数形式。
 * @method self value($value) 这里面 value 需要特殊说明一下，因为支持相对值。* `-2mins` 2分钟前\n * `+2days` 2天后\n* `-10week` 十周前\n可用单位： `min`、`hour`、`day`、`week`、`month`、`year`。所有单位支持复数形式。
 * @method self validationErrors($value) 验证失败的提示信息
 * @method self type($value) 
 * @method self size($value) 表单项大小 可选值: xs | sm | md | lg | full | 
 * @method self name($value) 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self borderMode($value) 边框模式，全边框，还是半边框，或者没边框。 可选值: full | half | none | 
 * @method self label($value) 描述标题
 * @method self validateApi($value) 远端校验表单项接口
 * @method self format($value) 默认 `X` 即时间戳格式，用来提交的时间格式。更多格式类型请参考 moment.
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self ranges($value) 日期范围快捷键
 * @method self readOnly($value) 是否只读
 * @method self staticOn($value) 是否静态展示表达式
 * @method self remark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容
 * @method self hint($value) 输入提示，聚焦的时候显示
 * @method self delimiter($value) 分割符, 因为有两个值，开始时间和结束时间，所以要有连接符。默认为英文逗号。
 * @method self inputFormat($value) 默认 `YYYY-MM-DD` 用来配置显示的时间格式。
 * @method self joinValues($value) 开启后将选中的选项 value 的值用连接符拼接起来，作为当前表单项的值。如： `value1,value2` 否则为 `[value1, value2]`
 * @method self startPlaceholder($value) 日期范围开始时间-占位符
 * @method self horizontal($value) 当配置为水平布局的时候，用来配置具体的左右分配。
 * @method self validations($value) 
 * @method self embed($value) 开启后变成非弹出模式，即内联模式。
 * @method self labelClassName($value) 配置 label className
 * @method self descriptionClassName($value) 配置描述上的 className
 * @method self placeholder($value) 占位符
 * @method self readOnlyOn($value) 只读条件
 * @method self className($value) 容器 css 类名
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self onEvent($value) 事件动作配置
 * @method self staticSchema($value) 
 * @method self width($value) 在Table中调整宽度
 * @method self maxDate($value) 最大日期限制，支持变量 $xxx 来取值，或者用相对值如：* `-2mins` 2分钟前\n * `+2days` 2天后\n* `-10week` 十周前\n可用单位： `min`、`hour`、`day`、`week`、`month`、`year`。所有单位支持复数形式。
 * @method self endPlaceholder($value) 日期范围结束时间-占位符
 * @method self animation($value) 是否启用游标动画，默认开启
 * @method self labelRemark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起
 * @method self labelAlign($value) 描述标题
 * @method self description($value) 描述内容，支持 Html 片段。
 * @method self inline($value) 表单 control 是否为 inline 模式。
 * @method self inputClassName($value) 配置 input className
 * @method self visible($value) 是否显示
 * @method self validateOnChange($value) 不设置时，当表单提交过后表单项每次修改都会触发重新验证， 如果设置了，则由此配置项来决定要不要每次修改都触发验证。
 * @method self disabled($value) 是否禁用
 * @method self clearValueOnHidden($value) 表单项隐藏时，是否在当前 Form 中删除掉该表单项值。注意同名的未隐藏的表单项值也会删掉
 * @method self disabledOn($value) 是否禁用表达式
 * @method self static($value) 是否静态展示
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self maxDuration($value) 最大跨度，比如 2days
 * @method self visibleOn($value) 是否显示表达式
 * @method self desc($value) 
 * @method self mode($value) 配置当前表单项展示模式 可选值: normal | inline | horizontal | 
 * @method self hidden($value) 是否隐藏
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 */
class QuarterRangeControl extends BaseRenderer
{
    public string $type = 'input-quarter-range';
}
