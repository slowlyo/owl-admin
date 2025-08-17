<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * SchemaPopOver
 * 
 * @author slowlyo
 * @version 6.12.0
 */
class SchemaPopOver extends BaseRenderer
{
    public function __construct()
    {
        

    }

    /**
     * 
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 弹出模式 可选值: dialog | drawer | popOver
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 偏移量
     */
    public function offset($value = '')
    {
        return $this->set('offset', $value);
    }

    /**
     * 弹框外层类名
     */
    public function popOverClassName($value = '')
    {
        return $this->set('popOverClassName', $value);
    }

    /**
     * 配置当前行是否启动，要用表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function popOverEnableOn($value = '')
    {
        return $this->set('popOverEnableOn', $value);
    }

    /**
     * 弹出位置 可选值: center | left-top | left-top-left-top | left-top-left-center | left-top-left-bottom | left-top-center-top | left-top-center-center | left-top-center-bottom | left-top-right-top | left-top-right-center | left-top-right-bottom | right-top | right-top-left-top | right-top-left-center | right-top-left-bottom | right-top-center-top | right-top-center-center | right-top-center-bottom | right-top-right-top | right-top-right-center | right-top-right-bottom | left-bottom | left-bottom-left-top | left-bottom-left-center | left-bottom-left-bottom | left-bottom-center-top | left-bottom-center-center | left-bottom-center-bottom | left-bottom-right-top | left-bottom-right-center | left-bottom-right-bottom | right-bottom | right-bottom-left-top | right-bottom-left-center | right-bottom-left-bottom | right-bottom-center-top | right-bottom-center-center | right-bottom-center-bottom | right-bottom-right-top | right-bottom-right-center | right-bottom-right-bottom | fixed-center | fixed-left-top | fixed-right-top | fixed-left-bottom | fixed-right-bottom
     */
    public function position($value = '')
    {
        return $this->set('position', $value);
    }

    /**
     * 是否显示查看更多的 icon，通常是放大图标。
     */
    public function showIcon($value = true)
    {
        return $this->set('showIcon', $value);
    }

    /**
     * 是弹窗形式的时候有用。 可选值: sm | md | lg | xl
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
    }

    /**
     * 标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 触发条件，默认是 click 可选值: click | hover
     */
    public function trigger($value = '')
    {
        return $this->set('trigger', $value);
    }


}
