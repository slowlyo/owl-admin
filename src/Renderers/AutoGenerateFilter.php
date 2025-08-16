<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * AutoGenerateFilter
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class AutoGenerateFilter extends BaseRenderer
{
    public function __construct()
    {
        

    }

    /**
     * 过滤条件单行列数
     */
    public function columnsNum($value = '')
    {
        return $this->set('columnsNum', $value);
    }

    /**
     * 是否默认收起
     */
    public function defaultCollapsed($value = true)
    {
        return $this->set('defaultCollapsed', $value);
    }

    /**
     * 是否启用多选框
     */
    public function enableBulkActions($value = true)
    {
        return $this->set('enableBulkActions', $value);
    }

    /**
     * 启用批量操作的表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function enableBulkActionsOn($value = '')
    {
        return $this->set('enableBulkActionsOn', $value);
    }

    /**
     * 是否显示设置查询字段
     */
    public function showBtnToolbar($value = true)
    {
        return $this->set('showBtnToolbar', $value);
    }


}
