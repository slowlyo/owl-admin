<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * ImageToolbarAction
 *
 * @author  slowlyo
 * @version 6.8.0
 */
class ImageToolbarAction extends BaseRenderer
{
    public function __construct()
    {
        $this->set('key', 'ROTATE_RIGHT');
    }

    /**
     * 确认弹窗标题
     */
    public function confirmTitle($value = '')
    {
        return $this->set('confirmTitle', $value);
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
