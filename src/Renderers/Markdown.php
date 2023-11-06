<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Markdown 渲染
 *
 * @author  slowlyo
 * @version 3.5.2
 */
class Markdown extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'markdown');
    }

    /**
     * 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 名称
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 外部地址
     */
    public function src($value = '')
    {
        return $this->set('src', $value);
    }

    /**
     * 指定为 markdown 渲染器。
     */
    public function type($value = 'markdown')
    {
        return $this->set('type', $value);
    }

    /**
     * 静态值
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
    }


}
