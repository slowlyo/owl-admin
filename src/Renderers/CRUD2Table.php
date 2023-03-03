<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * @method self perPageField($value) 设置分页一页显示的多少条数据的字段名。
 * @method self itemBadge($value) 行角标内容
 * @method self childrenColumnName($value) 数据源嵌套自定义字段名
 * @method self maxKeepItemSelectionLength($value) 批量操作最大限制数
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self autoJumpToTopOnPagerChange($value) 是否自动跳顶部，当切分页的时候。
 * @method self footerToolbar($value) 底部区域
 * @method self rowClassNameExpr($value) 自定义行样式
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self pageField($value) 设置分页页码字段名。
 * @method self hideQuickSaveBtn($value) 是否隐藏快速编辑的按钮。
 * @method self hidden($value) 是否隐藏
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self stopAutoRefreshWhen($value) 
 * @method self popOverContainer($value) 指定挂载dom
 * @method self keepItemSelectionOnPageChange($value) 翻页时是否保留用户已选的数据
 * @method self visibleOn($value) 是否显示表达式
 * @method self syncResponse2Query($value) 是否将接口返回的内容自动同步到地址栏，前提是开启了同步地址栏。
 * @method self bordered($value) 是否展示边框
 * @method self loadDataOnce($value) 是否为前端单次加载模式，可以用来实现前端分页。
 * @method self keyField($value) 嵌套展开记录的唯一标识
 * @method self reload($value) 重新加载的组件名称
 * @method self static($value) 是否静态展示
 * @method self expandable($value) 表格行可展开配置
 * @method self quickSaveApi($value) 快速编辑后用来批量保存的 API
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self loadType($value) 数据展示模式 无限加载 or 分页 可选值: more | pagination | 
 * @method self selectable($value) 是否可以选择数据，外部事件动作
 * @method self footer($value) 指定表尾
 * @method self actions($value) 操作列配置
 * @method self onEvent($value) 事件动作配置
 * @method self loadingConfig($value) 
 * @method self columnsTogglable($value) 表格可自定义列
 * @method self visible($value) 是否显示
 * @method self mode($value) 指定内容区的展示模式。
 * @method self autoFillHeight($value) 内容区域占满屏幕剩余空间
 * @method self staticOn($value) 是否静态展示表达式
 * @method self api($value) 初始化数据 API
 * @method self multiple($value) 是否可以多选数据，仅当selectable为 true 时生效
 * @method self loading($value) 加载中
 * @method self showSelection($value) 是否展示已选数据区域，仅当selectable为 true 时生效
 * @method self saveOrderApi($value) 保存排序的 api
 * @method self name($value) 
 * @method self type($value) 指定为 CRUD2 渲染器。
 * @method self perPage($value) 无限加载时，根据此项设置其每页加载数量，可以不限制
 * @method self rowSelection($value) 表格可选择配置
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticSchema($value) 
 * @method self primaryField($value) 快速编辑关键字段
 * @method self messages($value) 接口报错信息配置
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self silentPolling($value) 静默拉取
 * @method self columns($value) 表格列配置
 * @method self showBadge($value) 是否展示行角标
 * @method self lineHeight($value) 是否固定内容行高度
 * @method self quickSaveItemApi($value) 快速编辑配置成及时保存时使用的 API
 * @method self syncLocation($value) 是否将过滤条件的参数同步到地址栏,默认为true
 * @method self sticky($value) 粘性头部
 * @method self disabledOn($value) 是否禁用表达式
 * @method self interval($value) 设置自动刷新时间
 * @method self disabled($value) 是否禁用
 * @method self headerToolbar($value) 顶部区域
 * @method self title($value) 表格标题
 * @method self source($value) 也可以直接从环境变量中读取，但是不太推荐。
 * @method self showHeader($value) 是否展示表头
 * @method self className($value) 容器 css 类名
 */
class CRUD2Table extends BaseRenderer
{
    public string $type = 'crud2';
}
