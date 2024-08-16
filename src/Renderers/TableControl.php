<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * TableControl
 *
 * @author  slowlyo
 * @version 6.7.0
 */
class TableControl extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'input-table');
    }

    /**
     * 新增 API (新增 API)
     */
    public function addApi($value = '')
    {
        return $this->set('addApi', $value);
    }

    /**
     * 新增按钮图标
     */
    public function addBtnIcon($value = '')
    {
        return $this->set('addBtnIcon', $value);
    }

    /**
     * 新增按钮文字
     */
    public function addBtnLabel($value = '')
    {
        return $this->set('addBtnLabel', $value);
    }

    /**
     * 可新增
     */
    public function addable($value = true)
    {
        return $this->set('addable', $value);
    }

    /**
     * 是否固底
     */
    public function affixFooter($value = true)
    {
        return $this->set('affixFooter', $value);
    }

    /**
     * 是否固定表头
     */
    public function affixHeader($value = true)
    {
        return $this->set('affixHeader', $value);
    }

    /**
     * 底部总结行
     */
    public function affixRow($value = '')
    {
        return $this->set('affixRow', $value);
    }

    /**
     * 自动填充，当选项被选择的时候，将选项中的其他值同步设置到表单内。
     */
    public function autoFill($value = '')
    {
        return $this->set('autoFill', $value);
    }

    /**
     * 表格自动计算高度
     */
    public function autoFillHeight($value = '')
    {
        return $this->set('autoFillHeight', $value);
    }

    /**
     * 开启查询区域，会根据列元素的searchable属性值，自动生成查询条件表单
     */
    public function autoGenerateFilter($value = '')
    {
        return $this->set('autoGenerateFilter', $value);
    }

    /**
     * 是否可以访问父级数据，正常 combo 已经关联到数组成员，是不能访问父级数据的。
     */
    public function canAccessSuperData($value = true)
    {
        return $this->set('canAccessSuperData', $value);
    }

    /**
     * 取消按钮图标
     */
    public function cancelBtnIcon($value = '')
    {
        return $this->set('cancelBtnIcon', $value);
    }

    /**
     * 取消按钮文字
     */
    public function cancelBtnLabel($value = '')
    {
        return $this->set('cancelBtnLabel', $value);
    }

    /**
     * 是否可以新增子项
     */
    public function childrenAddable($value = true)
    {
        return $this->set('childrenAddable', $value);
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
     * 表格的列信息
     */
    public function columns($value = '')
    {
        return $this->set('columns', $value);
    }

    /**
     * 展示列显示开关，自动即：列数量大于或等于5个时自动开启
     */
    public function columnsTogglable($value = true)
    {
        return $this->set('columnsTogglable', $value);
    }

    /**
     * 合并单元格配置，配置从第几列开始合并。
     */
    public function combineFromIndex($value = '')
    {
        return $this->set('combineFromIndex', $value);
    }

    /**
     * 合并单元格配置，配置数字表示从左到右的多少列自动合并单元格。
     */
    public function combineNum($value = '')
    {
        return $this->set('combineNum', $value);
    }

    /**
     * 确认按钮图标
     */
    public function confirmBtnIcon($value = '')
    {
        return $this->set('confirmBtnIcon', $value);
    }

    /**
     * 确认按钮文字
     */
    public function confirmBtnLabel($value = '')
    {
        return $this->set('confirmBtnLabel', $value);
    }

    /**
     * 是否显示复制按钮
     */
    public function copyAddBtn($value = true)
    {
        return $this->set('copyAddBtn', $value);
    }

    /**
     * 复制按钮图标
     */
    public function copyBtnIcon($value = '')
    {
        return $this->set('copyBtnIcon', $value);
    }

    /**
     * 复制按钮文字
     */
    public function copyBtnLabel($value = '')
    {
        return $this->set('copyBtnLabel', $value);
    }

    /**
     * 复制的时候用来配置复制映射的数据。默认值是 {&:$$}，相当与复制整个行数据 通常有时候需要用来标记是复制过来的，也可能需要删掉一下主键字段。
     */
    public function copyData($value = '')
    {
        return $this->set('copyData', $value);
    }

    /**
     * 可复制新增
     */
    public function copyable($value = true)
    {
        return $this->set('copyable', $value);
    }

    /**
     * 懒加载 API，当行数据中用 defer: true 标记了，则其孩子节点将会用这个 API 来拉取数据。 (懒加载 API，当行数据中用 defer: true 标记了，则其孩子节点将会用这个 API 来拉取数据。)
     */
    public function deferApi($value = '')
    {
        return $this->set('deferApi', $value);
    }

    /**
     * 删除的 API (删除的 API)
     */
    public function deleteApi($value = '')
    {
        return $this->set('deleteApi', $value);
    }

    /**
     * 删除按钮图标
     */
    public function deleteBtnIcon($value = '')
    {
        return $this->set('deleteBtnIcon', $value);
    }

    /**
     * 删除按钮文字
     */
    public function deleteBtnLabel($value = '')
    {
        return $this->set('deleteBtnLabel', $value);
    }

    /**
     * 删除确认文字
     */
    public function deleteConfirmText($value = '')
    {
        return $this->set('deleteConfirmText', $value);
    }

    /**
     *
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
     * 是否禁用表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     * 是否可以拖拽排序
     */
    public function draggable($value = true)
    {
        return $this->set('draggable', $value);
    }

    /**
     * 更新按钮图标
     */
    public function editBtnIcon($value = '')
    {
        return $this->set('editBtnIcon', $value);
    }

    /**
     * 更新按钮名称
     */
    public function editBtnLabel($value = '')
    {
        return $this->set('editBtnLabel', $value);
    }

    /**
     * 可否编辑
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
     * 是否开启 static 状态切换
     */
    public function enableStaticTransform($value = true)
    {
        return $this->set('enableStaticTransform', $value);
    }

    /**
     * 额外的字段名，当为范围组件时可以用来将另外一个值打平出来
     */
    public function extraName($value = '')
    {
        return $this->set('extraName', $value);
    }

    /**
     * 是否开启底部展示功能，适合移动端展示
     */
    public function footable($value = true)
    {
        return $this->set('footable', $value);
    }

    /**
     * 底部新增按钮配置 (底部新增按钮配置)
     */
    public function footerAddBtn($value = '')
    {
        return $this->set('footerAddBtn', $value);
    }

    /**
     * 底部外层 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function footerClassName($value = '')
    {
        return $this->set('footerClassName', $value);
    }

    /**
     * 顶部外层 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function headerClassName($value = '')
    {
        return $this->set('headerClassName', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `data.xxx > 5`。)
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
     *
     */
    public function initAutoFill($value = '')
    {
        return $this->set('initAutoFill', $value);
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
     * 行角标 (Badge 角标。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/badge)
     */
    public function itemBadge($value = '')
    {
        return $this->set('itemBadge', $value);
    }

    /**
     * 描述标题
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
     * 限制最大个数
     */
    public function maxLength($value = '')
    {
        return $this->set('maxLength', $value);
    }

    /**
     * 限制最小个数
     */
    public function minLength($value = '')
    {
        return $this->set('minLength', $value);
    }

    /**
     * 配置当前表单项展示模式 可选值: normal | inline | horizontal
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 是否为确认的编辑模式。
     */
    public function needConfirm($value = true)
    {
        return $this->set('needConfirm', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 分页个数，默认不分页
     */
    public function perPage($value = '')
    {
        return $this->set('perPage', $value);
    }

    /**
     * 占位符
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 顶部总结行
     */
    public function prefixRow($value = '')
    {
        return $this->set('prefixRow', $value);
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
     * 可否删除
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
     * 是否可调整列宽
     */
    public function resizable($value = true)
    {
        return $this->set('resizable', $value);
    }

    /**
     *
     */
    public function row($value = '')
    {
        return $this->set('row', $value);
    }

    /**
     * 行样式表表达式
     */
    public function rowClassNameExpr($value = '')
    {
        return $this->set('rowClassNameExpr', $value);
    }

    /**
     * 是否立即保存(TableColumn中使用)
     */
    public function saveImmediately($value = true)
    {
        return $this->set('saveImmediately', $value);
    }

    /**
     * 初始值，新增的时候
     */
    public function scaffold($value = '')
    {
        return $this->set('scaffold', $value);
    }

    /**
     * 是否显示底部
     */
    public function showFooter($value = true)
    {
        return $this->set('showFooter', $value);
    }

    /**
     * 是否显示底部新增按钮
     */
    public function showFooterAddBtn($value = true)
    {
        return $this->set('showFooterAddBtn', $value);
    }

    /**
     * 是否显示头部
     */
    public function showHeader($value = true)
    {
        return $this->set('showHeader', $value);
    }

    /**
     * 是否显示序号
     */
    public function showIndex($value = true)
    {
        return $this->set('showIndex', $value);
    }

    /**
     * 是否显示表格操作栏新增按钮
     */
    public function showTableAddBtn($value = true)
    {
        return $this->set('showTableAddBtn', $value);
    }

    /**
     * 表单项大小 可选值: xs | sm | md | lg | full
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
    }

    /**
     * 数据源：绑定当前环境变量 (数据源：绑定当前环境变量)
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
     * 是否静态展示表达式 (表达式，语法 `data.xxx > 5`。)
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
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 孩子新增按钮图标
     */
    public function subAddBtnIcon($value = '')
    {
        return $this->set('subAddBtnIcon', $value);
    }

    /**
     * 孩子新增按钮文字
     */
    public function subAddBtnLabel($value = '')
    {
        return $this->set('subAddBtnLabel', $value);
    }

    /**
     * 当修改完的时候是否提交表单。
     */
    public function submitOnChange($value = true)
    {
        return $this->set('submitOnChange', $value);
    }

    /**
     * 表格 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function tableClassName($value = '')
    {
        return $this->set('tableClassName', $value);
    }

    /**
     * table layout 可选值: fixed | auto
     */
    public function tableLayout($value = '')
    {
        return $this->set('tableLayout', $value);
    }

    /**
     *
     */
    public function testIdBuilder($value = '')
    {
        return $this->set('testIdBuilder', $value);
    }

    /**
     *
     */
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 底部工具栏CSS样式类 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function toolbarClassName($value = '')
    {
        return $this->set('toolbarClassName', $value);
    }

    /**
     *
     */
    public function type($value = 'input-table')
    {
        return $this->set('type', $value);
    }

    /**
     * 更新 API (更新 API)
     */
    public function updateApi($value = '')
    {
        return $this->set('updateApi', $value);
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
     * 值字段
     */
    public function valueField($value = '')
    {
        return $this->set('valueField', $value);
    }

    /**
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式 (表达式，语法 `data.xxx > 5`。)
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
