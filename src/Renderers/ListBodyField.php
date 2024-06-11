<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 不指定类型默认就是文本
 *
 * @author  slowlyo
 * @version 6.5.0
 */
class ListBodyField extends BaseRenderer
{
    public function __construct()
    {


    }

    /**
     * 配置点击复制功能 (配置点击复制功能)
     */
    public function copyable($value = true)
    {
        return $this->set('copyable', $value);
    }

    /**
     * 内层组件的CSS类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
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
     * label 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
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
     * 配置查看详情功能 (配置查看详情功能)
     */
    public function popOver($value = '')
    {
        return $this->set('popOver', $value);
    }

    /**
     * 配置快速编辑功能 (配置快速编辑功能)
     */
    public function quickEdit($value = '')
    {
        return $this->set('quickEdit', $value);
    }


}
