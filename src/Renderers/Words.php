<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Words
 * 
 * @author slowlyo
 * @version 6.12.0
 */
class Words extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'words');


    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 展示文字 (展示文字)
     */
    public function collapseButton($value = '')
    {
        return $this->set('collapseButton', $value);
    }

    /**
     * 收起文字
     */
    public function collapseButtonText($value = '')
    {
        return $this->set('collapseButtonText', $value);
    }

    /**
     * 分割符
     */
    public function delimiter($value = '')
    {
        return $this->set('delimiter', $value);
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
     * 展示文字 (展示文字)
     */
    public function expendButton($value = '')
    {
        return $this->set('expendButton', $value);
    }

    /**
     * 展示文字
     */
    public function expendButtonText($value = '')
    {
        return $this->set('expendButtonText', $value);
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
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * useTag 当数据是数组时，是否使用tag的方式展示
     */
    public function inTag($value = '')
    {
        return $this->set('inTag', $value);
    }

    /**
     * 标签模板
     */
    public function labelTpl($value = '')
    {
        return $this->set('labelTpl', $value);
    }

    /**
     * 展示限制, 为0时也无限制
     */
    public function limit($value = '')
    {
        return $this->set('limit', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
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
     * 
     */
    public function type($value = 'words')
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

    /**
     * tags数据
     */
    public function words($value = '')
    {
        return $this->set('words', $value);
    }


}
