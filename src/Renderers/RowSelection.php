<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * RowSelection
 *
 * @author  slowlyo
 * @version v3.6.1
 */
class RowSelection extends BaseRenderer
{
    public function __construct()
    {


    }

    /**
     * 已选择的key值表达式
     */
    public function columnWidth($value = '')
    {
        return $this->set('columnWidth', $value);
    }

    /**
     * 行是否禁用表达式
     */
    public function disableOn($value = '')
    {
        return $this->set('disableOn', $value);
    }

    /**
     * 对应数据源的key值
     */
    public function keyField($value = '')
    {
        return $this->set('keyField', $value);
    }

    /**
     * 是否点击行触发选中或取消选中
     */
    public function rowClick($value = true)
    {
        return $this->set('rowClick', $value);
    }

    /**
     * 已选择的key值
     */
    public function selectedRowKeys($value = '')
    {
        return $this->set('selectedRowKeys', $value);
    }

    /**
     * 已选择的key值表达式
     */
    public function selectedRowKeysExpr($value = '')
    {
        return $this->set('selectedRowKeysExpr', $value);
    }

    /**
     * 自定义选择菜单
     */
    public function selections($value = '')
    {
        return $this->set('selections', $value);
    }

    /**
     * 选择类型 单选/多选
     */
    public function type($value = '')
    {
        return $this->set('type', $value);
    }


}
