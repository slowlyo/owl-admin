<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * CRUDList
 *
 * @author  slowlyo
 * @version 6.3.0
 */
class CRUDList extends BaseRenderer
{
    public function __construct()
    {
        $this->set('mode', 'list');
        $this->set('type', 'crud');
    }

    /**
     * 是否固底
     */
    public function affixFooter($value = true)
    {
        return $this->set('affixFooter', $value);
    }

    /**
     * 是否固顶
     */
    public function affixHeader($value = true)
    {
        return $this->set('affixHeader', $value);
    }

    /**
     * 默认只有当分页数大于 1 是才显示，如果总是想显示请配置。
     */
    public function alwaysShowPagination($value = true)
    {
        return $this->set('alwaysShowPagination', $value);
    }

    /**
     * 初始化数据 API (初始化数据 API)
     */
    public function api($value = '')
    {
        return $this->set('api', $value);
    }

    /**
     * 内容区域占满屏幕剩余空间
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
     * 是否自动跳顶部，当切分页的时候。
     */
    public function autoJumpToTopOnPagerChange($value = true)
    {
        return $this->set('autoJumpToTopOnPagerChange', $value);
    }

    /**
     * 批量操作
     */
    public function bulkActions($value = '')
    {
        return $this->set('bulkActions', $value);
    }

    /**
     * 点击列表单行时，是否选择
     */
    public function checkOnItemClick($value = true)
    {
        return $this->set('checkOnItemClick', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 可以默认给定初始参数如： {"perPage": 24} (可以默认给定初始参数如： {"perPage": 24})
     */
    public function defaultParams($value = '')
    {
        return $this->set('defaultParams', $value);
    }

    /**
     * 懒加载 API，当行数据中用 defer: true 标记了，则其孩子节点将会用这个 API 来拉取数据。 (懒加载 API，当行数据中用 defer: true 标记了，则其孩子节点将会用这个 API 来拉取数据。)
     */
    public function deferApi($value = '')
    {
        return $this->set('deferApi', $value);
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
     * 是否可通过拖拽排序
     */
    public function draggable($value = true)
    {
        return $this->set('draggable', $value);
    }

    /**
     * 是否可通过拖拽排序，通过表达式来配置 (表达式，语法 `data.xxx > 5`。)
     */
    public function draggableOn($value = '')
    {
        return $this->set('draggableOn', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 如果时内嵌模式，可以通过这个来配置默认的展开选项。
     */
    public function expandConfig($value = '')
    {
        return $this->set('expandConfig', $value);
    }

    /**
     * 过滤器表单
     */
    public function filter($value = '')
    {
        return $this->set('filter', $value);
    }

    /**
     *
     */
    public function filterDefaultVisible($value = true)
    {
        return $this->set('filterDefaultVisible', $value);
    }

    /**
     *
     */
    public function filterTogglable($value = true)
    {
        return $this->set('filterTogglable', $value);
    }

    /**
     * 底部区域 (底部区域)
     */
    public function footer($value = '')
    {
        return $this->set('footer', $value);
    }

    /**
     * 底部区域类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function footerClassName($value = '')
    {
        return $this->set('footerClassName', $value);
    }

    /**
     * 底部工具栏
     */
    public function footerToolbar($value = '')
    {
        return $this->set('footerToolbar', $value);
    }

    /**
     * 顶部区域 (顶部区域)
     */
    public function header($value = '')
    {
        return $this->set('header', $value);
    }

    /**
     * 顶部区域类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function headerClassName($value = '')
    {
        return $this->set('headerClassName', $value);
    }

    /**
     * 顶部工具栏
     */
    public function headerToolbar($value = '')
    {
        return $this->set('headerToolbar', $value);
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
     * 是否隐藏勾选框
     */
    public function hideCheckToggler($value = true)
    {
        return $this->set('hideCheckToggler', $value);
    }

    /**
     * 是否隐藏快速编辑的按钮。
     */
    public function hideQuickSaveBtn($value = true)
    {
        return $this->set('hideQuickSaveBtn', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 初始是否拉取
     */
    public function initFetch($value = true)
    {
        return $this->set('initFetch', $value);
    }

    /**
     * 初始是否拉取，用表达式来配置。 (表达式，语法 `data.xxx > 5`。)
     */
    public function initFetchOn($value = '')
    {
        return $this->set('initFetchOn', $value);
    }

    /**
     * 配置内部 DOM 的 className (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function innerClassName($value = '')
    {
        return $this->set('innerClassName', $value);
    }

    /**
     * 设置自动刷新时间
     */
    public function interval($value = '')
    {
        return $this->set('interval', $value);
    }

    /**
     * 点击列表项的行为 (点击列表项的行为)
     */
    public function itemAction($value = '')
    {
        return $this->set('itemAction', $value);
    }

    /**
     * 单条操作
     */
    public function itemActions($value = '')
    {
        return $this->set('itemActions', $value);
    }

    /**
     * 配置某项是否可以点选 (表达式，语法 `data.xxx > 5`。)
     */
    public function itemCheckableOn($value = '')
    {
        return $this->set('itemCheckableOn', $value);
    }

    /**
     * 配置某项是否可拖拽排序，前提是要开启拖拽功能 (表达式，语法 `data.xxx > 5`。)
     */
    public function itemDraggableOn($value = '')
    {
        return $this->set('itemDraggableOn', $value);
    }

    /**
     * 分页的时候是否保留用户选择。
     */
    public function keepItemSelectionOnPageChange($value = true)
    {
        return $this->set('keepItemSelectionOnPageChange', $value);
    }

    /**
     * 当配置 keepItemSelectionOnPageChange 时有用，用来配置已勾选项的文案。 (支持两种语法，但是不能混着用。分别是：1. `${xxx}` 或者 `${xxx|upperCase}` 2. `<%= data.xxx %>`
     * 更多文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template)
     */
    public function labelTpl($value = '')
    {
        return $this->set('labelTpl', $value);
    }

    /**
     * 单条数据展示内容配置 (单条数据展示内容配置)
     */
    public function listItem($value = '')
    {
        return $this->set('listItem', $value);
    }

    /**
     * 是否为前端单次加载模式，可以用来实现前端分页。
     */
    public function loadDataOnce($value = true)
    {
        return $this->set('loadDataOnce', $value);
    }

    /**
     * 在开启loadDataOnce时，当修改过滤条件时是否重新请求api如果没有配置，当查询条件表单触发的会重新请求 api，当是列过滤或者是 search-box 触发的则不重新请求 api 如果配置为 true，则不管是什么触发都会重新请求 api 如果配置为 false 则不管是什么触发都不会重新请求 api
     */
    public function loadDataOnceFetchOnFilter($value = true)
    {
        return $this->set('loadDataOnceFetchOnFilter', $value);
    }

    /**
     *
     */
    public function loadingConfig($value = '')
    {
        return $this->set('loadingConfig', $value);
    }

    /**
     * 自定义搜索匹配函数，当开启loadDataOnce时，会基于该函数计算的匹配结果进行过滤，主要用于处理列字段类型较为复杂或者字段值格式和后端返回不一致的场景
     */
    public function matchFunc($value = '')
    {
        return $this->set('matchFunc', $value);
    }

    /**
     * 消息文案配置，记住这个优先级是最低的，如果你的接口返回了 msg，接口返回的优先。
     */
    public function messages($value = '')
    {
        return $this->set('messages', $value);
    }

    /**
     * 指定内容区的展示模式。
     */
    public function mode($value = 'list')
    {
        return $this->set('mode', $value);
    }

    /**
     * 组件名字，这个名字可以用来定位，用于组件通信
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
     * 默认排序字段
     */
    public function orderBy($value = '')
    {
        return $this->set('orderBy', $value);
    }

    /**
     * 默认排序方向 可选值: asc | desc
     */
    public function orderDir($value = '')
    {
        return $this->set('orderDir', $value);
    }

    /**
     * 设置用来确定位置的字段名，设置后新的顺序将被赋值到该字段中。
     */
    public function orderField($value = '')
    {
        return $this->set('orderField', $value);
    }

    /**
     * 设置分页方向的字段名。单位简单分页时清楚时向前还是向后翻页。
     */
    public function pageDirectionField($value = '')
    {
        return $this->set('pageDirectionField', $value);
    }

    /**
     * 设置分页页码字段名。
     */
    public function pageField($value = '')
    {
        return $this->set('pageField', $value);
    }

    /**
     * 是否开启Query信息转换，开启后将会对url中的Query进行转换，默认开启，默认仅转化布尔值
     */
    public function parsePrimitiveQuery($value = '')
    {
        return $this->set('parsePrimitiveQuery', $value);
    }

    /**
     * 每页个数，默认为 10，如果不是请设置。
     */
    public function perPage($value = '')
    {
        return $this->set('perPage', $value);
    }

    /**
     * 每页显示多少个空间成员的配置如： [10, 20, 50, 100]。
     */
    public function perPageAvailable($value = true)
    {
        return $this->set('perPageAvailable', $value);
    }

    /**
     * 设置分页一页显示的多少条数据的字段名。
     */
    public function perPageField($value = '')
    {
        return $this->set('perPageField', $value);
    }

    /**
     * 无数据提示 (支持两种语法，但是不能混着用。分别是：1. `${xxx}` 或者 `${xxx|upperCase}` 2. `<%= data.xxx %>`
     * 更多文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template)
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 快速编辑后用来批量保存的 API (快速编辑后用来批量保存的 API)
     */
    public function quickSaveApi($value = '')
    {
        return $this->set('quickSaveApi', $value);
    }

    /**
     * 快速编辑配置成及时保存时使用的 API (快速编辑配置成及时保存时使用的 API)
     */
    public function quickSaveItemApi($value = '')
    {
        return $this->set('quickSaveItemApi', $value);
    }

    /**
     * 保存排序的 api (保存排序的 api)
     */
    public function saveOrderApi($value = '')
    {
        return $this->set('saveOrderApi', $value);
    }

    /**
     * 是否显示底部
     */
    public function showFooter($value = true)
    {
        return $this->set('showFooter', $value);
    }

    /**
     * 是否显示头部
     */
    public function showHeader($value = true)
    {
        return $this->set('showHeader', $value);
    }

    /**
     * 静默拉取
     */
    public function silentPolling($value = true)
    {
        return $this->set('silentPolling', $value);
    }

    /**
     * 大小 可选值: sm | base
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
    }

    /**
     * 也可以直接从环境变量中读取，但是不太推荐。 (也可以直接从环境变量中读取，但是不太推荐。)
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
     * 表达式，语法 `data.xxx > 5`。
     */
    public function stopAutoRefreshWhen($value = '')
    {
        return $this->set('stopAutoRefreshWhen', $value);
    }

    /**
     *
     */
    public function stopAutoRefreshWhenModalIsOpen($value = true)
    {
        return $this->set('stopAutoRefreshWhenModalIsOpen', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 是否将过滤条件的参数同步到地址栏,默认为true
     */
    public function syncLocation($value = true)
    {
        return $this->set('syncLocation', $value);
    }

    /**
     * 是否将接口返回的内容自动同步到地址栏，前提是开启了同步地址栏。
     */
    public function syncResponse2Query($value = true)
    {
        return $this->set('syncResponse2Query', $value);
    }

    /**
     * 标题 (支持两种语法，但是不能混着用。分别是：1. `${xxx}` 或者 `${xxx|upperCase}` 2. `<%= data.xxx %>`
     * 更多文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template)
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 指定为 CRUD 渲染器。
     */
    public function type($value = 'crud')
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
     * 可以用来作为值的字段
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


}
