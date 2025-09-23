<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * ImageToolbarAction
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class ImageToolbarAction extends BaseRenderer
{
    public function __construct()
    {
        $this->set('key', 'ROTATE_RIGHT');

        $this->set('type', 'action');
    }

    /**
     * 确认弹窗标题
     */
    public function confirmTitle($value = '')
    {
        return $this->set('confirmTitle', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * iconfont 里面的类名。
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    /**
     * 图标CSS类名
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
     * 描述标题, 当值为 false 时不展示
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }


}
