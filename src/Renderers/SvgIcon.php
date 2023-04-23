<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * SvgIcon
 * 
 * @author slowlyo
 * @version v2.9.0
 * @since 2023-04-23
 */
class SvgIcon extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'custom-svg-icon');

    }

    /**
     * 设置图标的类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 设置图标的名称
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    /**
     * 指定为 custom-svg-icon 渲染器。
     */
    public function type($value = 'custom-svg-icon')
    {
        return $this->set('type', $value);
    }

}
