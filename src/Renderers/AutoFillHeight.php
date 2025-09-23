<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * AutoFillHeight
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class AutoFillHeight extends BaseRenderer
{

    /**
     * Dialog 高度
     */
    public function height($value = '')
    {
        return $this->set('height', $value);
    }

    /**
     * 
     */
    public function maxHeight($value = '')
    {
        return $this->set('maxHeight', $value);
    }


}
