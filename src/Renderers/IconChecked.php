<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * IconChecked
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class IconChecked extends BaseRenderer
{

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 
     */
    public function svg($value = '')
    {
        return $this->set('svg', $value);
    }


}
