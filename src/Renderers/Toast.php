<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Toast 轻提示
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Toast extends BaseRenderer
{

    /**
     * 内容
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 是否显示关闭按钮
     */
    public function closeButton($value = true)
    {
        return $this->set('closeButton', $value);
    }

    /**
     * 轻提示内容
     */
    public function items($value = '')
    {
        return $this->set('items', $value);
    }

    /**
     * 展示图标，可选'info'/'success'/'error'/'warning' 可选值: info | success | warning | danger | link | primary | dark | light | secondary
     */
    public function level($value = '')
    {
        return $this->set('level', $value);
    }

    /**
     * 提示显示位置，可选值: top-right | top-center | top-left | bottom-center | bottom-left | bottom-right | center 可选值: top-right | top-center | top-left | bottom-center | bottom-left | bottom-right | center
     */
    public function position($value = '')
    {
        return $this->set('position', $value);
    }

    /**
     * 是否显示图标
     */
    public function showIcon($value = true)
    {
        return $this->set('showIcon', $value);
    }

    /**
     * 持续时间
     */
    public function timeout($value = '')
    {
        return $this->set('timeout', $value);
    }

    /**
     * 标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }


}
