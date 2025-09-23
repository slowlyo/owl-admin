<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * CRUDToolbar
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class CRUDToolbar extends BaseRenderer
{

    /**
     * 对齐方式 可选值: left | right
     */
    public function align($value = '')
    {
        return $this->set('align', $value);
    }

    /**
     * 约束批量操作
     */
    public function itemCheckableOn($value = '')
    {
        return $this->set('itemCheckableOn', $value);
    }


}
