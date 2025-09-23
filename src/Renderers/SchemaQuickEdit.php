<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * SchemaQuickEdit
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class SchemaQuickEdit extends BaseRenderer
{

    /**
     * 子内容
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 配置按钮图标
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    /**
     * 是否直接内嵌 可选值: normal | inline | horizontal
     */
    public function mode($value = 'inline')
    {
        return $this->set('mode', $value);
    }

    /**
     * 配置刷新目标，默认就会刷新所属 crud 组件， 如果不需要，请配置为 "none"
     */
    public function reload($value = '')
    {
        return $this->set('reload', $value);
    }

    /**
     * 接口保存失败后，是否重置组件编辑状态
     */
    public function resetOnFailed($value = true)
    {
        return $this->set('resetOnFailed', $value);
    }

    /**
     * 是否立即保存
     */
    public function saveImmediately($value = true)
    {
        return $this->set('saveImmediately', $value);
    }


}
