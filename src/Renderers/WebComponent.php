<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Web Component
 * 
 * @author slowlyo
 * @version v3.1.1
 * @since 2023-06-06
 */
class WebComponent extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'web-component');

    }

    /**
     * 子节点
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 标签上的属性
     */
    public function props($value = '')
    {
        return $this->set('props', $value);
    }

    /**
     * 具体使用的 web-component 标签
     */
    public function tag($value = '')
    {
        return $this->set('tag', $value);
    }

    /**
     * 指定为 web-component 渲染器。
     */
    public function type($value = 'web-component')
    {
        return $this->set('type', $value);
    }

}
