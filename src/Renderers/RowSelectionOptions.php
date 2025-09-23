<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * RowSelectionOptions
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class RowSelectionOptions extends BaseRenderer
{

    /**
     * 选择类型 选择全部 可选值: ROTATE_RIGHT | ROTATE_LEFT | ZOOM_IN | ZOOM_OUT | SCALE_ORIGIN
     */
    public function key($value = '')
    {
        return $this->set('key', $value);
    }

    /**
     * 选项显示文本
     */
    public function text($value = '')
    {
        return $this->set('text', $value);
    }


}
