<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 下拉按钮渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/dropdown-button
 *
 * @author  slowlyo
 * @version 6.11.0
 */
class DropdownButton extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'dropdown-button');
    }

    /**
     * 对齐方式 可选值: left | right
     */
    public function align($value = '')
    {
        return $this->set('align', $value);
    }

    /**
     * 是否独占一行 `display: block`
     */
    public function block($value = true)
    {
        return $this->set('block', $value);
    }

    /**
     * 内容区域 (内容区域)
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 给 Button 配置 className。 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function btnClassName($value = '')
    {
        return $this->set('btnClassName', $value);
    }

    /**
     * 按钮集合，支持分组
     */
    public function buttons($value = '')
    {
        return $this->set('buttons', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 点击内容是否关闭
     */
    public function closeOnClick($value = true)
    {
        return $this->set('closeOnClick', $value);
    }

    /**
     * 点击外部是否关闭
     */
    public function closeOnOutside($value = true)
    {
        return $this->set('closeOnOutside', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 是否显示下拉按钮
     */
    public function hideCaret($value = true)
    {
        return $this->set('hideCaret', $value);
    }

    /**
     * 是否只显示图标。
     */
    public function iconOnly($value = true)
    {
        return $this->set('iconOnly', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 按钮文字
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 按钮级别，样式 可选值: info | success | danger | warning | primary | link
     */
    public function level($value = '')
    {
        return $this->set('level', $value);
    }

    /**
     * 菜单 CSS 样式
     */
    public function menuClassName($value = '')
    {
        return $this->set('menuClassName', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     *
     */
    public function overlayPlacement($value = '')
    {
        return $this->set('overlayPlacement', $value);
    }

    /**
     * 右侧图标 (iconfont 里面的类名。)
     */
    public function rightIcon($value = '')
    {
        return $this->set('rightIcon', $value);
    }

    /**
     * 按钮大小 可选值: xs | sm | md | lg
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
    }

    /**
     * 是否静态展示
     */
    public function static($value = true)
    {
        return $this->set('static', $value);
    }

    /**
     * 静态展示表单项类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 静态展示表单项Value类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 静态展示表单项Label类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 是否静态展示表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function staticOn($value = '')
    {
        return $this->set('staticOn', $value);
    }

    /**
     * 静态展示空值占位
     */
    public function staticPlaceholder($value = '')
    {
        return $this->set('staticPlaceholder', $value);
    }

    /**
     *
     */
    public function staticSchema($value = '')
    {
        return $this->set('staticSchema', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     *
     */
    public function testIdBuilder($value = '')
    {
        return $this->set('testIdBuilder', $value);
    }

    /**
     *
     */
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 触发条件，默认是 click 可选值: click | hover
     */
    public function trigger($value = '')
    {
        return $this->set('trigger', $value);
    }

    /**
     * 指定为 DropDown Button 类型
     */
    public function type($value = 'dropdown-button')
    {
        return $this->set('type', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
