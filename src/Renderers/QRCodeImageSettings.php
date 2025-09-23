<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * QRCodeImageSettings
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class QRCodeImageSettings extends BaseRenderer
{

    /**
     * 
     */
    public function excavate($value = true)
    {
        return $this->set('excavate', $value);
    }

    /**
     * Dialog 高度
     */
    public function height($value = '')
    {
        return $this->set('height', $value);
    }

    /**
     * 图片地址
     */
    public function src($value = '')
    {
        return $this->set('src', $value);
    }

    /**
     * Dialog 宽度
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }

    /**
     * 起始横坐标位置，以 1 为起点
     */
    public function x($value = '')
    {
        return $this->set('x', $value);
    }

    /**
     * 起始纵坐标位置，以 1 为起点
     */
    public function y($value = '')
    {
        return $this->set('y', $value);
    }


}
