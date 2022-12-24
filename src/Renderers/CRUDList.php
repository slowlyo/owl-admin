<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self affixHeader($value) 是否固顶
 * @method self perPage($value) 每页个数，默认为 10，如果不是请设置。
 * @method self perPageAvailable($value) 每页显示多少个空间成员的配置如： [10, 20, 50, 100]。
 * @method self loadDataOnce($value) 是否为前端单次加载模式，可以用来实现前端分页。
 * @method self onEvent($value) 事件动作配置
 * @method self quickSaveApi($value) 快速编辑后用来批量保存的 API
 * @method self draggableOn($value) 是否可通过拖拽排序，通过表达式来配置
 * @method self stopAutoRefreshWhen($value) 
 * @method self syncResponse2Query($value) 是否将接口返回的内容自动同步到地址栏，前提是开启了同步地址栏。
 * @method self placeholder($value) 无数据提示
 * @method self size($value) 大小 可选值: sm | base | 
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self type($value) 指定为 CRUD 渲染器。
 * @method self itemActions($value) 单条操作
 * @method self pageField($value) 设置分页页码字段名。
 * @method self headerToolbar($value) 顶部工具栏
 * @method self footerClassName($value) 底部区域类名
 * @method self hidden($value) 是否隐藏
 * @method self api($value) 初始化数据 API
 * @method self orderBy($value) 默认排序字段
 * @method self interval($value) 设置自动刷新时间
 * @method self orderField($value) 设置用来确定位置的字段名，设置后新的顺序将被赋值到该字段中。
 * @method self silentPolling($value) 静默拉取
 * @method self itemCheckableOn($value) 配置某项是否可以点选
 * @method self valueField($value) 可以用来作为值的字段
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self mode($value) 指定内容区的展示模式。
 * @method self orderDir($value) 默认排序方向 可选值: asc | desc | 
 * @method self initFetchOn($value) 初始是否拉取，用表达式来配置。
 * @method self autoGenerateFilter($value) 开启查询区域，会根据列元素的searchable属性值，自动生成查询条件表单
 * @method self listItem($value) 单条数据展示内容配置
 * @method self visible($value) 是否显示
 * @method self static($value) 是否静态展示
 * @method self filter($value) 过滤器表单
 * @method self initFetch($value) 初始是否拉取
 * @method self stopAutoRefreshWhenModalIsOpen($value) 
 * @method self expandConfig($value) 如果时内嵌模式，可以通过这个来配置默认的展开选项。
 * @method self title($value) 标题
 * @method self className($value) 容器 css 类名
 * @method self disabled($value) 是否禁用
 * @method self perPageField($value) 设置分页一页显示的多少条数据的字段名。
 * @method self syncLocation($value) 是否将过滤条件的参数同步到地址栏,默认为true
 * @method self bulkActions($value) 批量操作
 * @method self source($value) 也可以直接从环境变量中读取，但是不太推荐。
 * @method self itemAction($value) 点击列表项的行为
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self defaultParams($value) 可以默认给定初始参数如： {\"perPage\": 24}
 * @method self header($value) 顶部区域
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticSchema($value) 
 * @method self draggable($value) 是否可通过拖拽排序
 * @method self showHeader($value) 是否显示头部
 * @method self visibleOn($value) 是否显示表达式
 * @method self innerClassName($value) 配置内部 DOM 的 className
 * @method self filterTogglable($value) 
 * @method self alwaysShowPagination($value) 默认只有当分页数大于 1 是才显示，如果总是想显示请配置。
 * @method self headerClassName($value) 顶部区域类名
 * @method self quickSaveItemApi($value) 快速编辑配置成及时保存时使用的 API
 * @method self autoFillHeight($value) 内容区域占满屏幕剩余空间
 * @method self itemDraggableOn($value) 配置某项是否可拖拽排序，前提是要开启拖拽功能
 * @method self staticOn($value) 是否静态展示表达式
 * @method self messages($value) 
 * @method self filterDefaultVisible($value) 
 * @method self labelTpl($value) 当配置 keepItemSelectionOnPageChange 时有用，用来配置已勾选项的文案。
 * @method self checkOnItemClick($value) 点击列表单行时，是否选择
 * @method self hideQuickSaveBtn($value) 是否隐藏快速编辑的按钮。
 * @method self autoJumpToTopOnPagerChange($value) 是否自动跳顶部，当切分页的时候。
 * @method self keepItemSelectionOnPageChange($value) 分页的时候是否保留用户选择。
 * @method self loadDataOnceFetchOnFilter($value) 在开启loadDataOnce时，filter时是否去重新请求api
 * @method self showFooter($value) 是否显示底部
 * @method self hideCheckToggler($value) 是否隐藏勾选框
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self footerToolbar($value) 底部工具栏
 * @method self footer($value) 底部区域
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self name($value) 
 * @method self saveOrderApi($value) 保存排序的 api
 */
class CRUDList extends BaseRenderer
{
    public string $type = 'crud';
    public string $mode = 'list';
}
