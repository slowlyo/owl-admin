<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * CRUD2
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class CRUD2 extends BaseRenderer
{

    /**
     * 约束批量操作
     */
    public function itemCheckableOn($value = '')
    {
        return $this->set('itemCheckableOn', $value);
    }


}
