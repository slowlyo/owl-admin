<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * TabsTransferPicker 穿梭器的弹框形态 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/tabs-transfer-picker
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class TabsTransferPickerControl extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'tabs-transfer-picker');
    }

    /**
     * 添加时调用的接口
     */
    public function addApi($value = '')
    {
        return $this->set('addApi', $value);
    }

    /**
     * 新增时的表单项。
     */
    public function addControls($value = '')
    {
        return $this->set('addControls', $value);
    }

    /**
     * 控制新增弹框设置项 (控制新增弹框设置项)
     */
    public function addDialog($value = '')
    {
        return $this->set('addDialog', $value);
    }

    /**
     * ui级联关系，true代表级联选中，false代表不级联，默认为true
     */
    public function autoCheckChildren($value = true)
    {
        return $this->set('autoCheckChildren', $value);
    }

    /**
     * 自动填充，当选项被选择的时候，将选项中的其他值同步设置到表单内。
     */
    public function autoFill($value = '')
    {
        return $this->set('autoFill', $value);
    }

    /**
     * 是否默认全选
     */
    public function checkAll($value = true)
    {
        return $this->set('checkAll', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 表单项隐藏时，是否在当前 Form 中删除掉该表单项值。注意同名的未隐藏的表单项值也会删掉
     */
    public function clearValueOnHidden($value = true)
    {
        return $this->set('clearValueOnHidden', $value);
    }

    /**
     * source从数据域取值时，数据域值变化后是否自动清空
     */
    public function clearValueOnSourceChange($value = true)
    {
        return $this->set('clearValueOnSourceChange', $value);
    }

    /**
     * 是否可清除
     */
    public function clearable($value = true)
    {
        return $this->set('clearable', $value);
    }

    /**
     * 当 selectMode 为 table 时定义表格列信息。
     */
    public function columns($value = '')
    {
        return $this->set('columns', $value);
    }

    /**
     * 是否可以新增
     */
    public function creatable($value = true)
    {
        return $this->set('creatable', $value);
    }

    /**
     * 新增文字
     */
    public function createBtnLabel($value = '')
    {
        return $this->set('createBtnLabel', $value);
    }

    /**
     * 懒加载 API，当行数据中用 defer: true 标记了，则其孩子节点将会用这个 API 来拉取数据。
     */
    public function deferApi($value = '')
    {
        return $this->set('deferApi', $value);
    }

    /**
     * 懒加载字段
     */
    public function deferField($value = '')
    {
        return $this->set('deferField', $value);
    }

    /**
     * 删除时调用的api
     */
    public function deleteApi($value = '')
    {
        return $this->set('deleteApi', $value);
    }

    /**
     * 确认删除时的提示
     */
    public function deleteConfirmText($value = '')
    {
        return $this->set('deleteConfirmText', $value);
    }

    /**
     * 配置值的连接符
     */
    public function delimiter($value = '')
    {
        return $this->set('delimiter', $value);
    }

    /**
     * 描述 (支持两种语法，但是不能混着用。分别是：1. `${xxx}` 或者 `${xxx|upperCase}` 2. `<%= data.xxx %>`
更多文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template)
     */
    public function desc($value = '')
    {
        return $this->set('desc', $value);
    }

    /**
     * 描述内容，支持 Html 片段。
     */
    public function description($value = '')
    {
        return $this->set('description', $value);
    }

    /**
     * 配置描述上的 className (配置描述上的 className)
     */
    public function descriptionClassName($value = '')
    {
        return $this->set('descriptionClassName', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     * 编辑时调用的 API
     */
    public function editApi($value = '')
    {
        return $this->set('editApi', $value);
    }

    /**
     * 选项修改的表单项
     */
    public function editControls($value = '')
    {
        return $this->set('editControls', $value);
    }

    /**
     * 控制编辑弹框设置项 (控制编辑弹框设置项)
     */
    public function editDialog($value = '')
    {
        return $this->set('editDialog', $value);
    }

    /**
     * 是否可编辑标签名
     */
    public function editable($value = true)
    {
        return $this->set('editable', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 额外的字段名，当为范围组件时可以用来将另外一个值打平出来
     */
    public function extraName($value = '')
    {
        return $this->set('extraName', $value);
    }

    /**
     * 开启后将选中的选项 value 的值封装为数组，作为当前表单项的值。
     */
    public function extractValue($value = true)
    {
        return $this->set('extractValue', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 输入提示，聚焦的时候显示
     */
    public function hint($value = '')
    {
        return $this->set('hint', $value);
    }

    /**
     * 当配置为水平布局的时候，用来配置具体的左右分配。 (当配置为水平布局的时候，用来配置具体的左右分配。)
     */
    public function horizontal($value = '')
    {
        return $this->set('horizontal', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 初始化时是否把其他字段同步到表单内部。
     */
    public function initAutoFill($value = true)
    {
        return $this->set('initAutoFill', $value);
    }

    /**
     * 是否默认就拉取？
     */
    public function initFetch($value = true)
    {
        return $this->set('initFetch', $value);
    }

    /**
     * 是否默认就拉取表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function initFetchOn($value = '')
    {
        return $this->set('initFetchOn', $value);
    }

    /**
     * 是否默认都展开
     */
    public function initiallyOpen($value = true)
    {
        return $this->set('initiallyOpen', $value);
    }

    /**
     * 表单 control 是否为 inline 模式。
     */
    public function inline($value = true)
    {
        return $this->set('inline', $value);
    }

    /**
     * 配置 input className (配置 input className)
     */
    public function inputClassName($value = '')
    {
        return $this->set('inputClassName', $value);
    }

    /**
     * 单个选项的高度，主要用于虚拟渲染
     */
    public function itemHeight($value = '')
    {
        return $this->set('itemHeight', $value);
    }

    /**
     * 当扁平化开启的时候，是否用分隔符的形式发送给后端，否则采用array的方式
     */
    public function joinValues($value = true)
    {
        return $this->set('joinValues', $value);
    }

    /**
     * 描述标题, 当值为 false 时不展示
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 描述标题 (描述标题) 可选值: right | left | top | inherit
     */
    public function labelAlign($value = '')
    {
        return $this->set('labelAlign', $value);
    }

    /**
     * 配置 label className
     */
    public function labelClassName($value = '')
    {
        return $this->set('labelClassName', $value);
    }

    /**
     * label展示形式 可选值: default | ellipsis
     */
    public function labelOverflow($value = '')
    {
        return $this->set('labelOverflow', $value);
    }

    /**
     * 显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起
     */
    public function labelRemark($value = '')
    {
        return $this->set('labelRemark', $value);
    }

    /**
     * label自定义宽度，默认单位为px
     */
    public function labelWidth($value = '')
    {
        return $this->set('labelWidth', $value);
    }

    /**
     * 当 selectMode 为 associated 时用来定义左侧的选择模式 可选值: tree | list
     */
    public function leftMode($value = '')
    {
        return $this->set('leftMode', $value);
    }

    /**
     * 当 selectMode 为 associated 时用来定义左侧的选项
     */
    public function leftOptions($value = '')
    {
        return $this->set('leftOptions', $value);
    }

    /**
     * 
     */
    public function loadingConfig($value = '')
    {
        return $this->set('loadingConfig', $value);
    }

    /**
     * 用来丰富选项展示
     */
    public function menuTpl($value = '')
    {
        return $this->set('menuTpl', $value);
    }

    /**
     * 配置当前表单项展示模式 可选值: normal | inline | horizontal
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 多图模式配置项
     */
    public function multiple($value = true)
    {
        return $this->set('multiple', $value);
    }

    /**
     * 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 树形模式下，仅选中子节点
     */
    public function onlyChildren($value = true)
    {
        return $this->set('onlyChildren', $value);
    }

    /**
     * 配置固定值
     */
    public function options($value = '')
    {
        return $this->set('options', $value);
    }

    /**
     * 分页配置，selectMode为默认和table才会生效
     */
    public function pagination($value = '')
    {
        return $this->set('pagination', $value);
    }

    /**
     * 占位符
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 是否只读
     */
    public function readOnly($value = true)
    {
        return $this->set('readOnly', $value);
    }

    /**
     * 只读条件
     */
    public function readOnlyOn($value = '')
    {
        return $this->set('readOnlyOn', $value);
    }

    /**
     * 显示一个小图标, 鼠标放上去的时候显示提示内容
     */
    public function remark($value = '')
    {
        return $this->set('remark', $value);
    }

    /**
     * 是否可删除
     */
    public function removable($value = true)
    {
        return $this->set('removable', $value);
    }

    /**
     * 是否为必填
     */
    public function required($value = true)
    {
        return $this->set('required', $value);
    }

    /**
     * 点清除按钮时，将表单项设置成当前配置的值。
     */
    public function resetValue($value = '')
    {
        return $this->set('resetValue', $value);
    }

    /**
     * 结果面板是否追踪显示
     */
    public function resultListModeFollowSelect($value = true)
    {
        return $this->set('resultListModeFollowSelect', $value);
    }

    /**
     * 右侧列表搜索框提示
     */
    public function resultSearchPlaceholder($value = '')
    {
        return $this->set('resultSearchPlaceholder', $value);
    }

    /**
     * 结果（右则）列表的检索功能，当设置为true时，可以通过输入检索模糊匹配检索内容
     */
    public function resultSearchable($value = true)
    {
        return $this->set('resultSearchable', $value);
    }

    /**
     * 右侧结果的标题文字
     */
    public function resultTitle($value = '')
    {
        return $this->set('resultTitle', $value);
    }

    /**
     * 当 selectMode 为 associated 时用来定义右侧的选择模式 可选值: table | list | tree | chained
     */
    public function rightMode($value = '')
    {
        return $this->set('rightMode', $value);
    }

    /**
     * 
     */
    public function row($value = '')
    {
        return $this->set('row', $value);
    }

    /**
     * 是否立即保存(TableColumn中使用)
     */
    public function saveImmediately($value = true)
    {
        return $this->set('saveImmediately', $value);
    }

    /**
     * 搜索 API
     */
    public function searchApi($value = '')
    {
        return $this->set('searchApi', $value);
    }

    /**
     * 左侧列表搜索框提示
     */
    public function searchPlaceholder($value = '')
    {
        return $this->set('searchPlaceholder', $value);
    }

    /**
     * 当 searchResultMode 为 table 时定义表格列信息。
     */
    public function searchResultColumns($value = '')
    {
        return $this->set('searchResultColumns', $value);
    }

    /**
     * 搜索结果展示模式 可选值: table | list | tree | chained
     */
    public function searchResultMode($value = '')
    {
        return $this->set('searchResultMode', $value);
    }

    /**
     * 可搜索？
     */
    public function searchable($value = true)
    {
        return $this->set('searchable', $value);
    }

    /**
     * 默认选择选项第一个值。
     */
    public function selectFirst($value = true)
    {
        return $this->set('selectFirst', $value);
    }

    /**
     * 勾选展示模式 可选值: table | list | tree | chained | associated
     */
    public function selectMode($value = '')
    {
        return $this->set('selectMode', $value);
    }

    /**
     * 左侧的标题文字
     */
    public function selectTitle($value = '')
    {
        return $this->set('selectTitle', $value);
    }

    /**
     * 是否显示剪头
     */
    public function showArrow($value = true)
    {
        return $this->set('showArrow', $value);
    }

    /**
     * 当在value值未匹配到当前options中的选项时，是否value值对应文本飘红显示
     */
    public function showInvalidMatch($value = true)
    {
        return $this->set('showInvalidMatch', $value);
    }

    /**
     * 表单项大小 可选值: xs | sm | md | lg | full
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
    }

    /**
     * 可排序？
     */
    public function sortable($value = true)
    {
        return $this->set('sortable', $value);
    }

    /**
     * 数据源: 绑定当前环境变量 (数据源: 绑定当前环境变量)
     */
    public function source($value = '')
    {
        return $this->set('source', $value);
    }

    /**
     * 是否静态展示
     */
    public function static($value = true)
    {
        return $this->set('static', $value);
    }

    /**
     * 静态展示表单项类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 静态展示表单项Value类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 静态展示表单项Label类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 是否静态展示表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function staticOn($value = '')
    {
        return $this->set('staticOn', $value);
    }

    /**
     * 静态展示空值占位
     */
    public function staticPlaceholder($value = '')
    {
        return $this->set('staticPlaceholder', $value);
    }

    /**
     * 
     */
    public function staticSchema($value = '')
    {
        return $this->set('staticSchema', $value);
    }

    /**
     * 统计数字
     */
    public function statistics($value = true)
    {
        return $this->set('statistics', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 当修改完的时候是否提交表单。
     */
    public function submitOnChange($value = true)
    {
        return $this->set('submitOnChange', $value);
    }

    /**
     * 指定为模板渲染器。文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template
     */
    public function type($value = 'tabs-transfer-picker')
    {
        return $this->set('type', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 远端校验表单项接口
     */
    public function validateApi($value = '')
    {
        return $this->set('validateApi', $value);
    }

    /**
     * 不设置时，当表单提交过后表单项每次修改都会触发重新验证， 如果设置了，则由此配置项来决定要不要每次修改都触发验证。
     */
    public function validateOnChange($value = true)
    {
        return $this->set('validateOnChange', $value);
    }

    /**
     * 验证失败的提示信息
     */
    public function validationErrors($value = '')
    {
        return $this->set('validationErrors', $value);
    }

    /**
     * 
     */
    public function validations($value = '')
    {
        return $this->set('validations', $value);
    }

    /**
     * 默认值，切记只能是静态值，不支持取变量，跟数据关联是通过设置 name 属性来实现的。
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
    }

    /**
     * 用来丰富值的展示
     */
    public function valueTpl($value = '')
    {
        return $this->set('valueTpl', $value);
    }

    /**
     * 多选模式，值太多时是否避免折行
     */
    public function valuesNoWrap($value = true)
    {
        return $this->set('valuesNoWrap', $value);
    }

    /**
     * 在选项数量达到多少时开启虚拟渲染
     */
    public function virtualThreshold($value = '')
    {
        return $this->set('virtualThreshold', $value);
    }

    /**
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }

    /**
     * 在Table中调整宽度
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }


}
