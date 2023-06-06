<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * IconChecked
 * 
 * @author slowlyo
 * @version v3.1.1
 * @since 2023-06-06
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

    public function svg($value = '')
    {
        return $this->set('svg', $value);
    }

}
