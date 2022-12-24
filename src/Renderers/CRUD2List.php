<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self className($value) 容器 css 类名
 * @method self loadType($value) 数据展示模式 无限加载 or 分页 可选值: more | pagination | 
 * @method self perPageField($value) 设置分页一页显示的多少条数据的字段名。
 * @method self name($value) 
 * @method self autoJumpToTopOnPagerChange($value) 是否自动跳顶部，当切分页的时候。
 * @method self showFooter($value) 是否显示底部
 * @method self checkOnItemClick($value) 点击列表单行时，是否选择
 * @method self keepItemSelectionOnPageChange($value) 翻页时是否保留用户已选的数据
 * @method self source($value) 也可以直接从环境变量中读取，但是不太推荐。
 * @method self disabled($value) 是否禁用
 * @method self staticOn($value) 是否静态展示表达式
 * @method self perPage($value) 无限加载时，根据此项设置其每页加载数量，可以不限制
 * @method self showSelection($value) 是否展示已选数据区域，仅当selectable为 true 时生效
 * @method self syncResponse2Query($value) 是否将接口返回的内容自动同步到地址栏，前提是开启了同步地址栏。
 * @method self static($value) 是否静态展示
 * @method self interval($value) 设置自动刷新时间
 * @method self loadDataOnce($value) 是否为前端单次加载模式，可以用来实现前端分页。
 * @method self showHeader($value) 是否显示头部
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self syncLocation($value) 是否将过滤条件的参数同步到地址栏,默认为true
 * @method self autoFillHeight($value) 内容区域占满屏幕剩余空间
 * @method self visibleOn($value) 是否显示表达式
 * @method self pageField($value) 设置分页页码字段名。
 * @method self footerClassName($value) 底部区域类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hideQuickSaveBtn($value) 是否隐藏快速编辑的按钮。
 * @method self selectable($value) 是否可以选择数据，外部事件动作
 * @method self headerClassName($value) 顶部区域类名
 * @method self hideCheckToggler($value) 是否隐藏勾选框
 * @method self itemCheckableOn($value) 配置某项是否可以点选
 * @method self size($value) 大小 可选值: sm | base | 
 * @method self itemAction($value) 点击列表项的行为
 * @method self hidden($value) 是否隐藏
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self footer($value) 底部区域
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self mode($value) 指定内容区的展示模式。
 * @method self type($value) 指定为 CRUD2 渲染器。
 * @method self api($value) 初始化数据 API
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self quickSaveApi($value) 快速编辑后用来批量保存的 API
 * @method self headerToolbar($value) 顶部区域
 * @method self itemDraggableOn($value) 配置某项是否可拖拽排序，前提是要开启拖拽功能
 * @method self silentPolling($value) 静默拉取
 * @method self stopAutoRefreshWhen($value) 
 * @method self title($value) 标题
 * @method self placeholder($value) 无数据提示
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self saveOrderApi($value) 保存排序的 api
 * @method self affixHeader($value) 是否固顶
 * @method self staticSchema($value) 
 * @method self valueField($value) 可以用来作为值的字段
 * @method self onEvent($value) 事件动作配置
 * @method self multiple($value) 是否可以多选数据，仅当selectable为 true 时生效
 * @method self quickSaveItemApi($value) 快速编辑配置成及时保存时使用的 API
 * @method self header($value) 顶部区域
 * @method self listItem($value) 单条数据展示内容配置
 * @method self visible($value) 是否显示
 * @method self footerToolbar($value) 底部区域
 */
class CRUD2List extends BaseRenderer
{
    public string $mode = 'list';
    public string $type = 'crud2';
}
