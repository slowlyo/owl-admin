<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * IconChecked
 * 
 * @author slowlyo
 * @version v2.9.0
 * @since 2023-04-23
 */
class IconChecked extends BaseRenderer
{
    public function __construct()
    {

    }

    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    public function name($value = '')
    {
        return $this->set('name', $value);
    }

}
