<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * ComboCondition
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class ComboCondition extends BaseRenderer
{

    /**
     * 状态项列表
     */
    public function items($value = '')
    {
        return $this->set('items', $value);
    }

    /**
     * 描述标题, 当值为 false 时不展示
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 配置当前表单项展示模式 可选值: normal | inline | horizontal
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 单组表单项初始值。默认为 `{}`
     */
    public function scaffold($value = '')
    {
        return $this->set('scaffold', $value);
    }

    /**
     * 
     */
    public function test($value = '')
    {
        return $this->set('test', $value);
    }


}
