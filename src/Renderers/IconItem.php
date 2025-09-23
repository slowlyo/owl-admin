<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * IconItem
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class IconItem extends BaseRenderer
{

    /**
     * iconfont 里面的类名。
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    /**
     * 角标位置 可选值: top-right | top-left | bottom-right | bottom-left
     */
    public function position($value = '')
    {
        return $this->set('position', $value);
    }


}
