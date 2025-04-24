<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Base
 * 
 * @author slowlyo
 * @version 6.12.0
 */
class Base extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'form');


    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
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
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
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
     *  可选值: form | alert | app | audio | avatar | button-group | breadcrumb | card | card2 | cards | carousel | chart | calendar | collapse | collapse-group | color | crud | crud2 | custom | date | static-date | datetime | static-datetime | time | static-time | month | static-month | date-range | dialog | spinner | divider | dropdown-button | drawer | each | flex | flex-item | grid-2d | icon | iframe | image | static-image | images | static-images | json-schema | json-schema-editor | json | static-json | link | list | log | static-list | map | mapping | markdown | nav | number | page | pagination | pagination-wrapper | property | operation | plain | text | progress | qrcode | qr-code | barcode | remark | search-box | sparkline | status | table | static-table | table2 | html | tpl | tasks | vbox | video | wizard | wrapper | web-component | anchor-nav | steps | timeline | control | input-array | button | submit | reset | button-group-select | button-toolbar | chained-select | chart-radios | checkbox | checkboxes | input-city | input-color | combo | condition-builder | container | switch-container | input-date | input-datetime | input-time | input-quarter | input-year | input-month | input-date-range | input-time-range | input-datetime-range | input-excel | input-formula | diff-editor | office-viewer | pdf-viewer | input-signature | input-verification-code | shape | editor | bat-editor | c-editor | coffeescript-editor | cpp-editor | csharp-editor | css-editor | dockerfile-editor | fsharp-editor | go-editor | handlebars-editor | html-editor | ini-editor | java-editor | javascript-editor | json-editor | less-editor | lua-editor | markdown-editor | msdax-editor | objective-c-editor | php-editor | plaintext-editor | postiats-editor | powershell-editor | pug-editor | python-editor | r-editor | razor-editor | ruby-editor | sb-editor | scss-editor | sol-editor | sql-editor | swift-editor | typescript-editor | vb-editor | xml-editor | yaml-editor | fieldset | fieldSet | input-file | formula | grid | group | hbox | hidden | icon-picker | icon-select | input-image | input-group | list-select | location-picker | matrix-checkboxes | input-month-range | input-quarter-range | nested-select | input-number | panel | picker | radio | radios | input-range | input-rating | input-repeat | input-rich-text | select | service | static | input-sub-form | switch | input-table | tabs | tabs-transfer | input-tag | input-text | input-password | input-email | input-url | uuid | multi-select | textarea | transfer | transfer-picker | tabs-transfer-picker | input-tree | tree-select | table-view | portlet | grid-nav | users-select | tag | tags | words | password | multiline-text | amis | native-date | native-time | native-number | code | tooltip-wrapper | slider
     */
    public function type($value = '')
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
