<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 不指定类型默认就是文本
 *
 * @author  slowlyo
 * @version v3.5.0
 */
class ListBodyField extends BaseRenderer
{
    public function __construct()
    {


    }

    /**
     * 配置点击复制功能
     */
    public function copyable($value = true)
    {
        return $this->set('copyable', $value);
    }

    /**
     * 内层组件的CSS类名
     */
    public function innerClassName($value = '')
    {
        return $this->set('innerClassName', $value);
    }

    /**
     * 列标题
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * label 类名
     */
    public function labelClassName($value = '')
    {
        return $this->set('labelClassName', $value);
    }

    /**
     * 绑定字段名
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 配置查看详情功能
     */
    public function popOver($value = '')
    {
        return $this->set('popOver', $value);
    }

    /**
     * 配置快速编辑功能
     */
    public function quickEdit($value = '')
    {
        return $this->set('quickEdit', $value);
    }


}
