<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * TableSchema2
 *
 * @author  slowlyo
 * @version 6.7.0
 */
class TableSchema2 extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'table2');
    }

    /**
     * 操作列配置
     */
    public function actions($value = '')
    {
        return $this->set('actions', $value);
    }

    /**
     * 表格自动计算高度
     */
    public function autoFillHeight($value = '')
    {
        return $this->set('autoFillHeight', $value);
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
     * 是否禁用表达式 (表达式，语法 `data.xxx > 5`。)
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
     * 指定表尾
     */
    public function footer($value = '')
    {
        return $this->set('footer', $value);
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
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 行角标内容 (Badge 角标。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/badge)
     */
    public function itemBadge($value = '')
    {
        return $this->set('itemBadge', $value);
    }

    /**
     * 翻页是否保存数据
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
     * 加载中
     */
    public function loading($value = '')
    {
        return $this->set('loading', $value);
    }

    /**
     * 批量操作最大限制数
     */
    public function maxKeepItemSelectionLength($value = '')
    {
        return $this->set('maxKeepItemSelectionLength', $value);
    }

    /**
     * 接口报错信息配置 (消息文案配置，记住这个优先级是最低的，如果你的接口返回了 msg，接口返回的优先。)
     */
    public function messages($value = '')
    {
        return $this->set('messages', $value);
    }

    /**
     * 是否可多选 作用同rowSelection.type 兼容原CRUD属性 不设置认为是多选 仅设置selectable才起作用
     */
    public function multiple($value = true)
    {
        return $this->set('multiple', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
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
     * 是否可选择 作用同rowSelection 兼容原CRUD属性 默认多选
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
     * 表格数据源 (表格数据源)
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
     * 粘性头部
     */
    public function sticky($value = true)
    {
        return $this->set('sticky', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     *  可选值: fixed | auto
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
     * 表格标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 指定为表格类型
     */
    public function type($value = 'table2')
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
     * 是否显示表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
