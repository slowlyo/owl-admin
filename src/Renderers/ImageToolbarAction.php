<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * ImageToolbarAction
 *
 * @author  slowlyo
 * @version v3.6.1
 */
class ImageToolbarAction extends BaseRenderer
{
    public function __construct()
    {
        $this->set('key', 'ROTATE_RIGHT');
    }

    /**
     *
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
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
    public function iconClassName($value = '')
    {
        return $this->set('iconClassName', $value);
    }

    /**
     *  可选值: ROTATE_RIGHT | ROTATE_LEFT | ZOOM_IN | ZOOM_OUT | SCALE_ORIGIN
     */
    public function key($value = '')
    {
        return $this->set('key', $value);
    }

    /**
     *
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }


}
