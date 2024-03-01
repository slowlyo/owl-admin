<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Flex 布局
 *
 * @author  slowlyo
 * @version 6.2.2
 */
class Flex extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'flex');
    }

    /**
     * stretch, start, flex-start, flex-end, end, center, baseline
     */
    public function alignItems($value = '')
    {
        return $this->set('alignItems', $value);
    }

    /**
     * css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 布局方向: column, row
     */
    public function direction($value = '')
    {
        return $this->set('direction', $value);
    }

    /**
     * 子元素, 数组表示多个
     */
    public function items($value = '')
    {
        return $this->set('items', $value);
    }

    /**
     * start, flex-start, center, end, flex-end, space-around, space-between, space-evenly
     */
    public function justify($value = '')
    {
        return $this->set('justify', $value);
    }

    /**
     * 自定义样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 指定为 flex 渲染器。
     */
    public function type($value = 'flex')
    {
        return $this->set('type', $value);
    }


}
