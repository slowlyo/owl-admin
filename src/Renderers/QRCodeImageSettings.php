<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * QRCodeImageSettings
 *
 * @author  slowlyo
 * @version 6.5.0
 */
class QRCodeImageSettings extends BaseRenderer
{
    public function __construct()
    {


    }

    /**
     *
     */
    public function excavate($value = true)
    {
        return $this->set('excavate', $value);
    }

    /**
     *
     */
    public function height($value = '')
    {
        return $this->set('height', $value);
    }

    /**
     *
     */
    public function src($value = '')
    {
        return $this->set('src', $value);
    }

    /**
     *
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }

    /**
     *
     */
    public function x($value = '')
    {
        return $this->set('x', $value);
    }

    /**
     *
     */
    public function y($value = '')
    {
        return $this->set('y', $value);
    }


}
