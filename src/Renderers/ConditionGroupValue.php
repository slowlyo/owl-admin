<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * ConditionGroupValue
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class ConditionGroupValue extends BaseRenderer
{
    public function __construct()
    {
        $this->set('conjunction', 'and');
    }

    /**
     * 表头分组
     */
    public function children($value = '')
    {
        return $this->set('children', $value);
    }

    /**
     *  可选值: and | or
     */
    public function conjunction($value = '')
    {
        return $this->set('conjunction', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 
     */
    public function not($value = true)
    {
        return $this->set('not', $value);
    }


}
