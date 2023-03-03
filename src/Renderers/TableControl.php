<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * @method self affixRow($value) 底部总结行
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self inline($value) 表单 control 是否为 inline 模式。
 * @method self validations($value) 
 * @method self valueField($value) 值字段
 * @method self showIndex($value) 是否显示序号
 * @method self perPage($value) 分页个数，默认不分页
 * @method self resizable($value) 是否可调整列宽
 * @method self rowClassNameExpr($value) 行样式表表达式
 * @method self autoFillHeight($value) 表格自动计算高度
 * @method self disabled($value) 是否禁用
 * @method self size($value) 表单项大小 可选值: xs | sm | md | lg | full | 
 * @method self editBtnIcon($value) 更新按钮图标
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self readOnly($value) 是否只读
 * @method self type($value) 
 * @method self copyable($value) 可复制新增
 * @method self editBtnLabel($value) 更新按钮名称
 * @method self showTableAddBtn($value) 是否显示表格操作栏新增按钮
 * @method self columns($value) 表格的列信息
 * @method self placeholder($value) 占位符
 * @method self hidden($value) 是否隐藏
 * @method self staticOn($value) 是否静态展示表达式
 * @method self confirmBtnIcon($value) 确认按钮图标
 * @method self showFooterAddBtn($value) 是否显示底部新增按钮
 * @method self copyBtnIcon($value) 复制按钮图标
 * @method self footerClassName($value) 底部外层 CSS 类名
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self remark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容
 * @method self submitOnChange($value) 当修改完的时候是否提交表单。
 * @method self validateOnChange($value) 不设置时，当表单提交过后表单项每次修改都会触发重新验证， 如果设置了，则由此配置项来决定要不要每次修改都触发验证。
 * @method self addable($value) 可新增
 * @method self validateApi($value) 远端校验表单项接口
 * @method self copyAddBtn($value) 是否显示复制按钮
 * @method self showHeader($value) 是否显示头部
 * @method self title($value) 标题
 * @method self combineNum($value) 合并单元格配置，配置数字表示从左到右的多少列自动合并单元格。
 * @method self static($value) 是否静态展示
 * @method self labelClassName($value) 配置 label className
 * @method self hint($value) 输入提示，聚焦的时候显示
 * @method self autoGenerateFilter($value) 开启查询区域，会根据列元素的searchable属性值，自动生成查询条件表单
 * @method self staticSchema($value) 
 * @method self label($value) 描述标题
 * @method self description($value) 描述内容，支持 Html 片段。
 * @method self horizontal($value) 当配置为水平布局的时候，用来配置具体的左右分配。
 * @method self value($value) 默认值，切记只能是静态值，不支持取变量，跟数据关联是通过设置 name 属性来实现的。
 * @method self cancelBtnLabel($value) 取消按钮文字
 * @method self width($value) 在Table中调整宽度
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self readOnlyOn($value) 只读条件
 * @method self mode($value) 配置当前表单项展示模式 可选值: normal | inline | horizontal | 
 * @method self inputClassName($value) 配置 input className
 * @method self draggable($value) 是否可以拖拽排序
 * @method self tableClassName($value) 表格 CSS 类名
 * @method self onEvent($value) 事件动作配置
 * @method self addBtnIcon($value) 新增按钮图标
 * @method self deleteApi($value) 删除的 API
 * @method self itemBadge($value) 行角标
 * @method self canAccessSuperData($value) 是否可以访问父级数据，正常 combo 已经关联到数组成员，是不能访问父级数据的。
 * @method self className($value) 容器 css 类名
 * @method self minLength($value) 限制最小个数
 * @method self descriptionClassName($value) 配置描述上的 className
 * @method self clearValueOnHidden($value) 表单项隐藏时，是否在当前 Form 中删除掉该表单项值。注意同名的未隐藏的表单项值也会删掉
 * @method self affixHeader($value) 是否固定表头
 * @method self columnsTogglable($value) 展示列显示开关，自动即：列数量大于或等于5个时自动开启
 * @method self visible($value) 是否显示
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self name($value) 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
 * @method self desc($value) 
 * @method self addBtnLabel($value) 新增按钮文字
 * @method self showFooter($value) 是否显示底部
 * @method self labelWidth($value) label自定义宽度，默认单位为px
 * @method self scaffold($value) 初始值，新增的时候
 * @method self needConfirm($value) 是否为确认的编辑模式。
 * @method self confirmBtnLabel($value) 确认按钮文字
 * @method self deleteBtnLabel($value) 删除按钮文字
 * @method self headerClassName($value) 顶部外层 CSS 类名
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self labelRemark($value) 显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起
 * @method self removable($value) 可否删除
 * @method self editable($value) 可否编辑
 * @method self deleteConfirmText($value) 删除确认文字
 * @method self maxLength($value) 限制最大个数
 * @method self toolbarClassName($value) 工具栏 CSS 类名
 * @method self required($value) 是否为必填
 * @method self cancelBtnIcon($value) 取消按钮图标
 * @method self footable($value) 是否开启底部展示功能，适合移动端展示
 * @method self prefixRow($value) 顶部总结行
 * @method self labelAlign($value) 描述标题
 * @method self copyBtnLabel($value) 复制按钮文字
 * @method self updateApi($value) 更新 API
 * @method self footerAddBtn($value) 底部新增按钮配置
 * @method self source($value) 数据源：绑定当前环境变量
 * @method self combineFromIndex($value) 合并单元格配置，配置从第几列开始合并。
 * @method self disabledOn($value) 是否禁用表达式
 * @method self validationErrors($value) 验证失败的提示信息
 * @method self addApi($value) 新增 API
 * @method self deleteBtnIcon($value) 删除按钮图标
 */
class TableControl extends BaseRenderer
{
    public string $type = 'input-table';
}
