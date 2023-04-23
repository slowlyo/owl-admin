<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * IconItem
 * 
 * @author slowlyo
 * @version v2.9.0
 * @since 2023-04-23
 */
class IconItem extends BaseRenderer
{
    public function __construct()
    {

    }

    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    public function position($value = '')
    {
        return $this->set('position', $value);
    }

}
