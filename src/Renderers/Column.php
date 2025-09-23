<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Column
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Column extends BaseRenderer
{

    /**
     * 内容居左、居中、居右 可选值: left | right
     */
    public function align($value = '')
    {
        return $this->set('align', $value);
    }

    /**
     * 表格列单元格是否可以获取父级数据域值，默认为true，该配置对当前列内单元格生效
     */
    public function canAccessSuperData($value = true)
    {
        return $this->set('canAccessSuperData', $value);
    }

    /**
     * 表头分组
     */
    public function children($value = '')
    {
        return $this->set('children', $value);
    }

    /**
     * 列样式
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 单元格样式
     */
    public function classNameExpr($value = '')
    {
        return $this->set('classNameExpr', $value);
    }

    /**
     * 指定列合并表达式
     */
    public function colSpanExpr($value = '')
    {
        return $this->set('colSpanExpr', $value);
    }

    /**
     * 可复制
     */
    public function copyable($value = true)
    {
        return $this->set('copyable', $value);
    }

    /**
     * 兼容table列筛选
     */
    public function filterable($value = true)
    {
        return $this->set('filterable', $value);
    }

    /**
     * 是否固定在左侧/右侧 可选值: left | right | none
     */
    public function fixed($value = '')
    {
        return $this->set('fixed', $value);
    }

    /**
     * 标题内容居左、居中、居右 可选值: left | center | right
     */
    public function headerAlign($value = '')
    {
        return $this->set('headerAlign', $value);
    }

    /**
     * 指定列唯一标识
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 配置快速编辑功能 (配置快速编辑功能)
     */
    public function quickEdit($value = '')
    {
        return $this->set('quickEdit', $value);
    }

    /**
     * 列表头提示
     */
    public function remark($value = '')
    {
        return $this->set('remark', $value);
    }

    /**
     * 指定行合并表达式
     */
    public function rowSpanExpr($value = '')
    {
        return $this->set('rowSpanExpr', $value);
    }

    /**
     * 快速搜索
     */
    public function searchable($value = true)
    {
        return $this->set('searchable', $value);
    }

    /**
     * 兼容table快速排序
     */
    public function sortable($value = true)
    {
        return $this->set('sortable', $value);
    }

    /**
     * 快速排序
     */
    public function sorter($value = true)
    {
        return $this->set('sorter', $value);
    }

    /**
     * 指定列标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 表头单元格样式
     */
    public function titleClassName($value = '')
    {
        return $this->set('titleClassName', $value);
    }

    /**
     * 当前列是否展示
     */
    public function toggled($value = true)
    {
        return $this->set('toggled', $value);
    }

    /**
     * 指定列内容渲染器
     */
    public function type($value = '')
    {
        return $this->set('type', $value);
    }

    /**
     * 列垂直对齐方式 可选值: top | middle | bottom
     */
    public function vAlign($value = '')
    {
        return $this->set('vAlign', $value);
    }

    /**
     * Dialog 宽度
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }


}
