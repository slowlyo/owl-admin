<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * CRUD2Table
 * 
 * @author slowlyo
 * @version v3.4.0
 */
class CRUD2Table extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'crud2');


    }

    /**
     * 操作列配置
     */
    public function actions($value = '')
    {
        return $this->set('actions', $value);
    }

    /**
     * 初始化数据 API
     */
    public function api($value = '')
    {
        return $this->set('api', $value);
    }

    /**
     * 内容区域占满屏幕剩余空间
     */
    public function autoFillHeight($value = true)
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
     * 数据源嵌套自定义字段名
     */
    public function childrenColumnName($value = '')
    {
        return $this->set('childrenColumnName', $value);
    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 表格列配置
     */
    public function columns($value = '')
    {
        return $this->set('columns', $value);
    }

    /**
     * 表格可自定义列
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
     * 是否禁用表达式
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
     * 表格行可展开配置
     */
    public function expandable($value = true)
    {
        return $this->set('expandable', $value);
    }

    /**
     * 指定表尾
     */
    public function footer($value = '')
    {
        return $this->set('footer', $value);
    }

    /**
     * 底部区域
     */
    public function footerToolbar($value = '')
    {
        return $this->set('footerToolbar', $value);
    }

    /**
     * 底部区域CSS类名
     */
    public function footerToolbarClassName($value = '')
    {
        return $this->set('footerToolbarClassName', $value);
    }

    /**
     * 顶部区域
     */
    public function headerToolbar($value = '')
    {
        return $this->set('headerToolbar', $value);
    }

    /**
     * 顶部区域CSS类名
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
     * 是否隐藏表达式
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
     * 设置自动刷新时间
     */
    public function interval($value = '')
    {
        return $this->set('interval', $value);
    }

    /**
     * 行角标内容
     */
    public function itemBadge($value = '')
    {
        return $this->set('itemBadge', $value);
    }

    /**
     * 翻页时是否保留用户已选的数据
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
     * 数据展示模式 无限加载 or 分页 可选值: more | pagination
     */
    public function loadType($value = '')
    {
        return $this->set('loadType', $value);
    }

    /**
     * 加载中
     */
    public function loading($value = '')
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
     * 批量操作最大限制数
     */
    public function maxKeepItemSelectionLength($value = '')
    {
        return $this->set('maxKeepItemSelectionLength', $value);
    }

    /**
     * 接口报错信息配置
     */
    public function messages($value = '')
    {
        return $this->set('messages', $value);
    }

    /**
     * 指定内容区的展示模式。
     */
    public function mode($value = 'table2')
    {
        return $this->set('mode', $value);
    }

    /**
     * 是否可以多选数据，仅当selectable为 true 时生效
     */
    public function multiple($value = true)
    {
        return $this->set('multiple', $value);
    }

    /**
     * 
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
     * 无限加载时，根据此项设置其每页加载数量，可以不限制
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
     * 重新加载的组件名称
     */
    public function reload($value = '')
    {
        return $this->set('reload', $value);
    }

    /**
     * 自定义行样式
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
     * 是否可以选择数据，外部事件动作
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
     * 是否展示表头
     */
    public function showHeader($value = true)
    {
        return $this->set('showHeader', $value);
    }

    /**
     * 是否展示已选数据区域，仅当selectable为 true 时生效
     */
    public function showSelection($value = true)
    {
        return $this->set('showSelection', $value);
    }

    /**
     * 静默拉取
     */
    public function silentPolling($value = true)
    {
        return $this->set('silentPolling', $value);
    }

    /**
     * 也可以直接从环境变量中读取，但是不太推荐。
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
     * 静态展示表单项类名
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 静态展示表单项Value类名
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 静态展示表单项Label类名
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 是否静态展示表达式
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
     * 
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
     * 表格标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 指定为 CRUD2 渲染器。
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
     * 是否显示表达式
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
