<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * IconItem
 *
 * @author  slowlyo
 * @version 3.5.2
 */
class IconItem extends BaseRenderer
{
    public function __construct()
    {


    }

    /**
     *
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    /**
     *
     */
    public function position($value = '')
    {
        return $this->set('position', $value);
    }


}
