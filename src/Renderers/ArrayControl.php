<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * InputArray 数组输入框。 combo 的别名。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/array
 *
 * @method self submitOnChange($value) 当修改完的时候是否提交表单。
 * @method self horizontal($value) 当配置为水平布局的时候，用来配置具体的左右分配。
 * @method self addButtonClassName($value) 新增按钮CSS类名
 * @method self addable($value) 是否可新增
 * @method self draggableTip($value) 可拖拽排序的提示信息。
 * @method self removable($value) 是否可删除
 * @method self tabsStyle($value) Tabs 的展示模式。 可选值:  | line | card | radio | 
 * @method self tabsLabelTpl($value) 选项卡标题的生成模板。
 * @method self className($value) 容器 css 类名
 * @method self disabled($value) 是否禁用
 * @method self onEvent($value) 事件动作配置
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self width($value) 在Table中调整宽度
 * @method self validationErrors($value) 验证失败的提示信息
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self placeholder($value) 没有成员时显示。
 * @method self strictMode($value) 严格模式，为了性能默认不开的。
 * @method self labelRemark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起
 * @method self inline($value) 表单 control 是否为 inline 模式。
 * @method self validateApi($value) 远端校验表单项接口
 * @method self static($value) 是否静态展示
 * @method self nullable($value) 允许为空，如果子表单项里面配置验证器，且又是单条模式。可以允许用户选择清空（不填）。
 * @method self label($value) 描述标题
 * @method self syncFields($value) 配置同步字段。只有 `strictMode` 为 `false` 时有效。 如果 Combo 层级比较深，底层的获取外层的数据可能不同步。 但是给 combo 配置这个属性就能同步下来。输入格式：`["os"]`
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self flat($value) 是否将结果扁平化(去掉name),只有当controls的length为1且multiple为true的时候才有效
 * @method self delimiter($value) 当扁平化开启并且joinValues为true时，用什么分隔符
 * @method self canAccessSuperData($value) 是否可以访问父级数据，正常 combo 已经关联到数组成员，是不能访问父级数据的。
 * @method self messages($value) 提示信息
 * @method self inputClassName($value) 配置 input className
 * @method self hidden($value) 是否隐藏
 * @method self visibleOn($value) 是否显示表达式
 * @method self deleteConfirmText($value) 确认删除时的提示
 * @method self formClassName($value) 内部单组表单项的类名
 * @method self addattop($value) Add at top
 * @method self readOnly($value) 是否只读
 * @method self validateOnChange($value) 不设置时，当表单提交过后表单项每次修改都会触发重新验证， 如果设置了，则由此配置项来决定要不要每次修改都触发验证。
 * @method self typeSwitchable($value) 是否可切换条件，配合`conditions`使用
 * @method self minLength($value) 限制最小个数
 * @method self multiple($value) 是否可多选
 * @method self type($value) 指定为数组输入框类型
 * @method self labelClassName($value) 配置 label className
 * @method self descriptionClassName($value) 配置描述上的 className
 * @method self clearValueOnHidden($value) 表单项隐藏时，是否在当前 Form 中删除掉该表单项值。注意同名的未隐藏的表单项值也会删掉
 * @method self labelAlign($value) 描述标题
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self staticSchema($value) 
 * @method self deleteApi($value) 删除时调用的api
 * @method self size($value) 表单项大小 可选值: xs | sm | md | lg | full | 
 * @method self desc($value) 
 * @method self noBorder($value) 是否含有边框
 * @method self addButtonText($value) 新增按钮文字
 * @method self labelWidth($value) label自定义宽度，默认单位为px
 * @method self mode($value) 配置当前表单项展示模式 可选值: normal | inline | horizontal | 
 * @method self value($value) 默认值，切记只能是静态值，不支持取变量，跟数据关联是通过设置 name 属性来实现的。
 * @method self disabledOn($value) 是否禁用表达式
 * @method self visible($value) 是否显示
 * @method self draggable($value) 是否可拖拽排序
 * @method self joinValues($value) 当扁平化开启的时候，是否用分隔符的形式发送给后端，否则采用array的方式
 * @method self lazyLoad($value) 数据比较多，比较卡时，可以试试开启。
 * @method self remark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容
 * @method self name($value) 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
 * @method self readOnlyOn($value) 只读条件
 * @method self tabsMode($value) 采用 Tabs 展示方式？
 * @method self description($value) 描述内容，支持 Html 片段。
 * @method self maxLength($value) 限制最大个数
 * @method self subFormMode($value) 子表单的模式。 可选值: normal | horizontal | inline | 
 * @method self items($value) 成员渲染器配置
 * @method self scaffold($value) 新增成员时的默认值
 * @method self multiLine($value) 是否多行模式，默认一行展示完
 * @method self hint($value) 输入提示，聚焦的时候显示
 * @method self required($value) 是否为必填
 * @method self validations($value) 
 */
class ArrayControl extends BaseRenderer
{
    public string $type = 'input-array';
}
