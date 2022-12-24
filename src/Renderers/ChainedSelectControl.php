<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * 链式下拉框 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/chained-select
 *
 * @method self delimiter($value) 分割符
 * @method self placeholder($value) 占位符
 * @method self validations($value) 
 * @method self hidden($value) 是否隐藏
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self initFetchOn($value) 用表达式来配置 source 接口初始要不要拉取
 * @method self editApi($value) 编辑时调用的 API
 * @method self size($value) 表单项大小 可选值: xs | sm | md | lg | full | 
 * @method self mode($value) 配置当前表单项展示模式 可选值: normal | inline | horizontal | 
 * @method self horizontal($value) 当配置为水平布局的时候，用来配置具体的左右分配。
 * @method self resetValue($value) 点清除按钮时，将表单项设置成当前配置的值。
 * @method self editControls($value) 选项修改的表单项
 * @method self submitOnChange($value) 当修改完的时候是否提交表单。
 * @method self visible($value) 是否显示
 * @method self value($value) 默认值，切记只能是静态值，不支持取变量，跟数据关联是通过设置 name 属性来实现的。
 * @method self clearValueOnHidden($value) 表单项隐藏时，是否在当前 Form 中删除掉该表单项值。注意同名的未隐藏的表单项值也会删掉
 * @method self initFetch($value) 配置 source 接口初始拉不拉取。
 * @method self extractValue($value) 开启后将选中的选项 value 的值封装为数组，作为当前表单项的值。
 * @method self addControls($value) 新增时的表单项。
 * @method self labelAlign($value) 描述标题
 * @method self validationErrors($value) 验证失败的提示信息
 * @method self name($value) 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
 * @method self disabled($value) 是否禁用
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self removable($value) 是否可删除
 * @method self deleteApi($value) 选项删除 API
 * @method self readOnlyOn($value) 只读条件
 * @method self inputClassName($value) 配置 input className
 * @method self label($value) 描述标题
 * @method self options($value) 选项集合
 * @method self multiple($value) 是否为多选模式
 * @method self addDialog($value) 控制新增弹框设置项
 * @method self creatable($value) 是否可以新增
 * @method self editDialog($value) 控制编辑弹框设置项
 * @method self addApi($value) 添加时调用的接口
 * @method self validateOnChange($value) 不设置时，当表单提交过后表单项每次修改都会触发重新验证， 如果设置了，则由此配置项来决定要不要每次修改都触发验证。
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self width($value) 在Table中调整宽度
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self labelRemark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起
 * @method self selectFirst($value) 默认选择选项第一个值。
 * @method self deferApi($value) 延时加载的 API，当选项中有 defer: true 的选项时，点开会通过此接口扩充。
 * @method self createBtnLabel($value) 新增文字
 * @method self deleteConfirmText($value) 选项删除提示文字。
 * @method self labelClassName($value) 配置 label className
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticSchema($value) 
 * @method self source($value) 可用来通过 API 拉取 options。
 * @method self clearable($value) 是否可清除。
 * @method self autoFill($value) 自动填充，当选项被选择的时候，将选项中的其他值同步设置到表单内。
 * @method self desc($value) 
 * @method self descriptionClassName($value) 配置描述上的 className
 * @method self type($value) 表单项类型
 * @method self joinValues($value) 单选模式：当用户选中某个选项时，选项中的 value 将被作为该表单项的值提交，否则，整个选项对象都会作为该表单项的值提交。 多选模式：选中的多个选项的 `value` 会通过 `delimiter` 连接起来，否则直接将以数组的形式提交值。
 * @method self onEvent($value) 事件动作配置
 * @method self required($value) 是否为必填
 * @method self static($value) 是否静态展示
 * @method self labelWidth($value) label自定义宽度，默认单位为px
 * @method self inline($value) 表单 control 是否为 inline 模式。
 * @method self remark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容
 * @method self hint($value) 输入提示，聚焦的时候显示
 * @method self className($value) 容器 css 类名
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self editable($value) 是否可以编辑
 * @method self readOnly($value) 是否只读
 * @method self description($value) 描述内容，支持 Html 片段。
 * @method self validateApi($value) 远端校验表单项接口
 * @method self visibleOn($value) 是否显示表达式
 */
class ChainedSelectControl extends BaseRenderer
{
    public string $type = 'chained-select';
}
