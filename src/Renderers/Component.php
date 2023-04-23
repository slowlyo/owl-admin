<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 万能组件
 *
 * 可以组合出任意组件<br/>
 * 使用setType(), 设置组件类型<br/>
 * 组件的其余属性可以直接调用对应属性名的方法如: ->value($value), 会有__call()来实现该方法<br/>
 * 也可以使用set(属性名, 属性值)方法来设置组件的属性<br/>
 */
class Component extends BaseRenderer
{
    public function setType($type): static
    {
        return $this->set('type', $type);
    }
}
