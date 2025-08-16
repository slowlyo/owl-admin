<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * InputTextAddOn
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class InputTextAddOn extends BaseRenderer
{
    public function __construct()
    {
        

    }

    /**
     * 操作按钮位置 可选值: left | right
     */
    public function position($value = '')
    {
        return $this->set('position', $value);
    }


}
