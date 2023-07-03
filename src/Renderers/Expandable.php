<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Expandable
 * 
 * @author slowlyo
 * @version v3.2.0
 */
class Expandable extends BaseRenderer
{
    public function __construct()
    {

    }

    /**
     * 行是否可展开表达式
     */
    public function expandableOn($value = '')
    {
        return $this->set('expandableOn', $value);
    }

    /**
     * 展开行自定义样式表达式
     */
    public function expandedRowClassNameExpr($value = '')
    {
        return $this->set('expandedRowClassNameExpr', $value);
    }

    /**
     * 已展开的key值
     */
    public function expandedRowKeys($value = '')
    {
        return $this->set('expandedRowKeys', $value);
    }

    /**
     * 已展开的key值表达式
     */
    public function expandedRowKeysExpr($value = '')
    {
        return $this->set('expandedRowKeysExpr', $value);
    }

    /**
     * 对应数据源的key值
     */
    public function keyField($value = '')
    {
        return $this->set('keyField', $value);
    }

    /**
     * 对应渲染器类型
     */
    public function type($value = '')
    {
        return $this->set('type', $value);
    }

}
