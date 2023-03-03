<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Select 下拉选择框。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/select
 *
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self leftMode($value) 当 selectMode 为 associated 时用来定义左侧的选择模式 可选值: tree | list | 
 * @method self labelField($value) 设置label字段
 * @method self addDialog($value) 控制新增弹框设置项
 * @method self hint($value) 输入提示，聚焦的时候显示
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self autoComplete($value) 自动完成 API，当输入部分文字的时候，会将这些文字通过 ${term} 可以取到，发送给接口。 接口可以返回匹配到的选项，帮助用户输入。
 * @method self searchResultMode($value) 搜索结果展示模式 可选值: table | list | tree | chained | 
 * @method self loadingConfig($value) 
 * @method self removable($value) 是否可删除
 * @method self inputClassName($value) 配置 input className
 * @method self width($value) 在Table中调整宽度
 * @method self readOnly($value) 是否只读
 * @method self placeholder($value) 占位符
 * @method self overflowTagPopover($value) 收纳标签的Popover配置
 * @method self options($value) 选项集合
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self searchResultColumns($value) 当 searchResultMode 为 table 时定义表格列信息。
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hidden($value) 是否隐藏
 * @method self checkAll($value) 可多选条件下，是否可全选
 * @method self defaultCheckAll($value) 可多选条件下，是否默认全选中所有值
 * @method self extractValue($value) 开启后将选中的选项 value 的值封装为数组，作为当前表单项的值。
 * @method self editable($value) 是否可以编辑
 * @method self editDialog($value) 控制编辑弹框设置项
 * @method self readOnlyOn($value) 只读条件
 * @method self required($value) 是否为必填
 * @method self searchable($value) 是否可搜索
 * @method self addControls($value) 新增时的表单项。
 * @method self size($value) 表单项大小 可选值: xs | sm | md | lg | full | 
 * @method self labelAlign($value) 描述标题
 * @method self submitOnChange($value) 当修改完的时候是否提交表单。
 * @method self inline($value) 表单 control 是否为 inline 模式。
 * @method self static($value) 是否静态展示
 * @method self columns($value) 当 selectMode 为 table 时定义表格列信息。
 * @method self initFetch($value) 配置 source 接口初始拉不拉取。
 * @method self clearable($value) 是否可清除。
 * @method self deferApi($value) 延时加载的 API，当选项中有 defer: true 的选项时，点开会通过此接口扩充。
 * @method self name($value) 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
 * @method self disabled($value) 是否禁用
 * @method self menuTpl($value) 可以自定义菜单展示。
 * @method self selectMode($value) 勾选展示模式 可选值: table | group | tree | chained | associated | 
 * @method self rightMode($value) 当 selectMode 为 associated 时用来定义右侧的选择模式 可选值: table | list | tree | chained | 
 * @method self multiple($value) 是否为多选模式
 * @method self addApi($value) 添加时调用的接口
 * @method self editApi($value) 编辑时调用的 API
 * @method self valueField($value) 设置value字段
 * @method self validateApi($value) 远端校验表单项接口
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self labelRemark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起
 * @method self itemHeight($value) 单个选项的高度，主要用于虚拟渲染
 * @method self virtualThreshold($value) 在选项数量达到多少时开启虚拟渲染
 * @method self createBtnLabel($value) 新增文字
 * @method self deleteConfirmText($value) 选项删除提示文字。
 * @method self validations($value) 
 * @method self checkAllLabel($value) 可多选条件下，全选项文案，默认 ”全选“
 * @method self autoCheckChildren($value) 是否自动选中子节点
 * @method self descriptionClassName($value) 配置描述上的 className
 * @method self validationErrors($value) 验证失败的提示信息
 * @method self optionClassName($value) 选项的自定义CSS类名
 * @method self source($value) 可用来通过 API 拉取 options。
 * @method self editControls($value) 选项修改的表单项
 * @method self deleteApi($value) 选项删除 API
 * @method self className($value) 容器 css 类名
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self initFetchOn($value) 用表达式来配置 source 接口初始要不要拉取
 * @method self delimiter($value) 分割符
 * @method self resetValue($value) 点清除按钮时，将表单项设置成当前配置的值。
 * @method self leftOptions($value) 当 selectMode 为 associated 时用来定义左侧的选项
 * @method self joinValues($value) 单选模式：当用户选中某个选项时，选项中的 value 将被作为该表单项的值提交，否则，整个选项对象都会作为该表单项的值提交。 多选模式：选中的多个选项的 `value` 会通过 `delimiter` 连接起来，否则直接将以数组的形式提交值。
 * @method self onEvent($value) 事件动作配置
 * @method self staticSchema($value) 
 * @method self type($value) 表单项类型 可选值: select | multi-select | 
 * @method self searchApi($value) 搜索 API
 * @method self maxTagCount($value) 标签的最大展示数量，超出数量后以收纳浮层的方式展示，仅在多选模式开启后生效
 * @method self overlay($value) 下拉框 Popover 设置
 * @method self creatable($value) 是否可以新增
 * @method self labelClassName($value) 配置 label className
 * @method self clearValueOnHidden($value) 表单项隐藏时，是否在当前 Form 中删除掉该表单项值。注意同名的未隐藏的表单项值也会删掉
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self remark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容
 * @method self borderMode($value) 边框模式，全边框，还是半边框，或者没边框。 可选值: full | half | none | 
 * @method self labelWidth($value) label自定义宽度，默认单位为px
 * @method self horizontal($value) 当配置为水平布局的时候，用来配置具体的左右分配。
 * @method self visible($value) 是否显示
 * @method self desc($value) 
 * @method self value($value) 默认值，切记只能是静态值，不支持取变量，跟数据关联是通过设置 name 属性来实现的。
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self selectFirst($value) 默认选择选项第一个值。
 * @method self autoFill($value) 自动填充，当选项被选择的时候，将选项中的其他值同步设置到表单内。
 * @method self description($value) 描述内容，支持 Html 片段。
 * @method self showInvalidMatch($value) 当在value值未匹配到当前options中的选项时，是否value值对应文本飘红显示
 * @method self label($value) 描述标题
 * @method self validateOnChange($value) 不设置时，当表单提交过后表单项每次修改都会触发重新验证， 如果设置了，则由此配置项来决定要不要每次修改都触发验证。
 * @method self mode($value) 配置当前表单项展示模式 可选值: normal | inline | horizontal | 
 */
class SelectControl extends BaseRenderer
{
    public string $type = 'select';
}
