<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Badge 角标。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/badge
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Badge extends BaseRenderer
{

    /**
     * 是否显示动画 可选值: fade | slide | marquee
     */
    public function animation($value = true)
    {
        return $this->set('animation', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 提示类型 可选值: info | success | warning | danger | link | primary | dark | light | secondary
     */
    public function level($value = '')
    {
        return $this->set('level', $value);
    }

    /**
     * 角标类型 可选值: text | dot | ribbon
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 角标位置，相对于position的位置进行偏移
     */
    public function offset($value = '')
    {
        return $this->set('offset', $value);
    }

    /**
     * 封顶的数字值
     */
    public function overflowCount($value = '')
    {
        return $this->set('overflowCount', $value);
    }

    /**
     * 角标位置 可选值: top-right | top-left | bottom-right | bottom-left
     */
    public function position($value = '')
    {
        return $this->set('position', $value);
    }

    /**
     * 大小 可选值: xs | sm | md | lg | full
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
    }

    /**
     * 角标的自定义样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 文本内容
     */
    public function text($value = '')
    {
        return $this->set('text', $value);
    }

    /**
     * 动态控制是否显示
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
