<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * CRUD2Table
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class CRUD2Table extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'crud2');
    }

    /**
     * 默认不用填写，自动会创建确认和取消按钮。
     */
    public function actions($value = '')
    {
        return $this->set('actions', $value);
    }

    /**
     * 配置 ajax 发送地址 (配置 ajax 发送地址)
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
     * 是否自动跳顶部，当切分页的时候。
     */
    public function autoJumpToTopOnPagerChange($value = true)
    {
        return $this->set('autoJumpToTopOnPagerChange', $value);
    }

    /**
     * 是否展示边框
     */
    public function bordered($value = true)
    {
        return $this->set('bordered', $value);
    }

    /**
     * 表格是否可以获取父级数据域值，默认为false
     */
    public function canAccessSuperData($value = true)
    {
        return $this->set('canAccessSuperData', $value);
    }

    /**
     * 数据源嵌套自定义字段名
     */
    public function childrenColumnName($value = '')
    {
        return $this->set('childrenColumnName', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
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
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 表格行可展开配置 (表格行可展开配置)
     */
    public function expandable($value = true)
    {
        return $this->set('expandable', $value);
    }

    /**
     * 底部 (底部)
     */
    public function footer($value = '')
    {
        return $this->set('footer', $value);
    }

    /**
     * 底部工具栏
     */
    public function footerToolbar($value = '')
    {
        return $this->set('footerToolbar', $value);
    }

    /**
     * 
     */
    public function footerToolbarClassName($value = '')
    {
        return $this->set('footerToolbarClassName', $value);
    }

    /**
     * 顶部工具栏
     */
    public function headerToolbar($value = '')
    {
        return $this->set('headerToolbar', $value);
    }

    /**
     * 
     */
    public function headerToolbarClassName($value = '')
    {
        return $this->set('headerToolbarClassName', $value);
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
     * 配置轮询间隔，配置后 initApi 将轮询加载。
     */
    public function interval($value = '')
    {
        return $this->set('interval', $value);
    }

    /**
     * 行角标 (Badge 角标。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/badge)
     */
    public function itemBadge($value = '')
    {
        return $this->set('itemBadge', $value);
    }

    /**
     * 约束批量操作
     */
    public function itemCheckableOn($value = '')
    {
        return $this->set('itemCheckableOn', $value);
    }

    /**
     * 分页的时候是否保留用户选择。
     */
    public function keepItemSelectionOnPageChange($value = true)
    {
        return $this->set('keepItemSelectionOnPageChange', $value);
    }

    /**
     * 多选、嵌套展开记录的ID字段名 默认id
     */
    public function keyField($value = '')
    {
        return $this->set('keyField', $value);
    }

    /**
     * 当一次性渲染太多列上有用，默认为 100，可以用来提升表格渲染性能
     */
    public function lazyRenderAfter($value = '')
    {
        return $this->set('lazyRenderAfter', $value);
    }

    /**
     * 是否固定内容行高度
     */
    public function lineHeight($value = '')
    {
        return $this->set('lineHeight', $value);
    }

    /**
     * 是否为前端单次加载模式，可以用来实现前端分页。
     */
    public function loadDataOnce($value = true)
    {
        return $this->set('loadDataOnce', $value);
    }

    /**
     * 
     */
    public function loadType($value = '')
    {
        return $this->set('loadType', $value);
    }

    /**
     * 是否处于加载状态
     */
    public function loading($value = true)
    {
        return $this->set('loading', $value);
    }

    /**
     * 
     */
    public function loadingConfig($value = '')
    {
        return $this->set('loadingConfig', $value);
    }

    /**
     * 当开启 keepItemSelectionOnPageChange 时，最大保留已勾选项的数量。
     */
    public function maxKeepItemSelectionLength($value = '')
    {
        return $this->set('maxKeepItemSelectionLength', $value);
    }

    /**
     * 消息文案配置，记住这个优先级是最低的，如果你的接口返回了 msg，接口返回的优先。
     */
    public function messages($value = '')
    {
        return $this->set('messages', $value);
    }

    /**
     * 配置当前表单项展示模式 可选值: normal | inline | horizontal
     */
    public function mode($value = 'table2')
    {
        return $this->set('mode', $value);
    }

    /**
     * 多图模式配置项
     */
    public function multiple($value = '')
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
     * 设置分页一页显示的多少条数据的字段名。
     */
    public function perPageField($value = '')
    {
        return $this->set('perPageField', $value);
    }

    /**
     * 指定挂载dom
     */
    public function popOverContainer($value = '')
    {
        return $this->set('popOverContainer', $value);
    }

    /**
     * 设置ID字段名 作用同keyFiled 兼容原CURD属性
     */
    public function primaryField($value = '')
    {
        return $this->set('primaryField', $value);
    }

    /**
     * 下拉刷新配置
     */
    public function pullRefresh($value = '')
    {
        return $this->set('pullRefresh', $value);
    }

    /**
     * 快速编辑后用来批量保存的 API
     */
    public function quickSaveApi($value = '')
    {
        return $this->set('quickSaveApi', $value);
    }

    /**
     * 快速编辑配置成及时保存时使用的 API
     */
    public function quickSaveItemApi($value = '')
    {
        return $this->set('quickSaveItemApi', $value);
    }

    /**
     * 配置刷新动作，这个动作通常在完成渲染器本省的固定动作后出发。一般用来配置目标组件的 name 属性。多个目标可以用逗号隔开。当目标是 windows 时表示刷新整个页面。刷新目标的同时还支持传递参数如： `foo?a=${a}&b=${b},boo?c=${c}`
     */
    public function reload($value = '')
    {
        return $this->set('reload', $value);
    }

    /**
     * 行样式表表达式
     */
    public function rowClassNameExpr($value = '')
    {
        return $this->set('rowClassNameExpr', $value);
    }

    /**
     * 表格可选择配置
     */
    public function rowSelection($value = '')
    {
        return $this->set('rowSelection', $value);
    }

    /**
     * 保存排序的 api
     */
    public function saveOrderApi($value = '')
    {
        return $this->set('saveOrderApi', $value);
    }

    /**
     * 是否开启行选择功能, 默认为 false 开启后将支持行选择功能,需要结合事件动作使用
     */
    public function selectable($value = true)
    {
        return $this->set('selectable', $value);
    }

    /**
     * 是否展示行角标
     */
    public function showBadge($value = true)
    {
        return $this->set('showBadge', $value);
    }

    /**
     * 是否显示头部
     */
    public function showHeader($value = true)
    {
        return $this->set('showHeader', $value);
    }

    /**
     * 
     */
    public function showSelection($value = '')
    {
        return $this->set('showSelection', $value);
    }

    /**
     * 是否要静默加载，也就是说不显示进度
     */
    public function silentPolling($value = true)
    {
        return $this->set('silentPolling', $value);
    }

    /**
     * 数据源: 绑定当前环境变量 (数据源: 绑定当前环境变量)
     */
    public function source($value = '')
    {
        return $this->set('source', $value);
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
     * 粘性头部
     */
    public function sticky($value = true)
    {
        return $this->set('sticky', $value);
    }

    /**
     * 配置停止轮询的条件。 (表达式，语法 `${xxx > 5}`。)
     */
    public function stopAutoRefreshWhen($value = '')
    {
        return $this->set('stopAutoRefreshWhen', $value);
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
     * table layout 可选值: fixed | auto
     */
    public function tableLayout($value = '')
    {
        return $this->set('tableLayout', $value);
    }

    /**
     * 
     */
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 页面标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 指定为模板渲染器。文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template
     */
    public function type($value = 'crud2')
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


}
