<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Custom 自定义组件
 *
 * @author  slowlyo
 * @version v3.5.3
 */
class Custom extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'custom');
    }

    /**
     * 节点 class
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 初始化节点 html
     */
    public function html($value = '')
    {
        return $this->set('html', $value);
    }

    /**
     * 节点 id
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 默认使用 div 标签，如果 true 就使用 span 标签
     */
    public function inline($value = true)
    {
        return $this->set('inline', $value);
    }

    /**
     * 节点 名称
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 节点初始化之后调的用函数
     */
    public function onMount($value = '')
    {
        return $this->set('onMount', $value);
    }

    /**
     * 节点销毁的时候调用的函数
     */
    public function onUnmount($value = '')
    {
        return $this->set('onUnmount', $value);
    }

    /**
     * 数据有更新的时候调用的函数
     */
    public function onUpdate($value = '')
    {
        return $this->set('onUpdate', $value);
    }

    /**
     * 指定为 custom 渲染器。
     */
    public function type($value = 'custom')
    {
        return $this->set('type', $value);
    }


}
