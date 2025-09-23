<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 图片展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/image
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Image extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'image');
    }

    /**
     * 图片无法显示时的替换文本
     */
    public function alt($value = '')
    {
        return $this->set('alt', $value);
    }

    /**
     * 是否新窗口打开
     */
    public function blank($value = true)
    {
        return $this->set('blank', $value);
    }

    /**
     * 图片说明文字 (支持两种语法，但是不能混着用。分别是：1. `${xxx}` 或者 `${xxx|upperCase}` 2. `<%= data.xxx %>`
更多文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template)
     */
    public function caption($value = '')
    {
        return $this->set('caption', $value);
    }

    /**
     * 外层 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 默认图片地址 (默认图片地址)
     */
    public function defaultImage($value = '')
    {
        return $this->set('defaultImage', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式 (表达式，语法 `${xxx > 5}`。)
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
     * 是否启动放大功能。
     */
    public function enlargeAble($value = true)
    {
        return $this->set('enlargeAble', $value);
    }

    /**
     * 放大时是否显示图片集
     */
    public function enlargeWithGallary($value = true)
    {
        return $this->set('enlargeWithGallary', $value);
    }

    /**
     * 描述文字样式
     */
    public function fontStyle($value = '')
    {
        return $this->set('fontStyle', $value);
    }

    /**
     * 高度
     */
    public function height($value = '')
    {
        return $this->set('height', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 鼠标悬浮时的展示状态（对应AIpage的文字6，9，10不存在） 可选值: hover-slide | pull-top | scale-center | scale-top | text-style-1 | text-style-2 | text-style-3 | text-style-4 | text-style-5 | text-style-6 | text-style-7
     */
    public function hoverMode($value = '')
    {
        return $this->set('hoverMode', $value);
    }

    /**
     * 链接地址 (支持两种语法，但是不能混着用。分别是：1. `${xxx}` 或者 `${xxx|upperCase}` 2. `<%= data.xxx %>`
更多文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template)
     */
    public function href($value = '')
    {
        return $this->set('href', $value);
    }

    /**
     * 链接的 target
     */
    public function htmlTarget($value = '')
    {
        return $this->set('htmlTarget', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 图片描述信息 (支持两种语法，但是不能混着用。分别是：1. `${xxx}` 或者 `${xxx|upperCase}` 2. `<%= data.xxx %>`
更多文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template)
     */
    public function imageCaption($value = '')
    {
        return $this->set('imageCaption', $value);
    }

    /**
     * 图片 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function imageClassName($value = '')
    {
        return $this->set('imageClassName', $value);
    }

    /**
     * 放大详情图 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function imageGallaryClassName($value = '')
    {
        return $this->set('imageGallaryClassName', $value);
    }

    /**
     * 图片展示模式，默认为缩略图模式、可以配置成原图模式 可选值: thumb | original
     */
    public function imageMode($value = '')
    {
        return $this->set('imageMode', $value);
    }

    /**
     * 组件内层 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function innerClassName($value = '')
    {
        return $this->set('innerClassName', $value);
    }

    /**
     * 蒙层颜色
     */
    public function maskColor($value = '')
    {
        return $this->set('maskColor', $value);
    }

    /**
     * 关联字段名，也可以直接配置 src
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 大图地址，不设置用 src (大图地址，不设置用 src)
     */
    public function originalSrc($value = '')
    {
        return $this->set('originalSrc', $value);
    }

    /**
     * 是否展示图片工具栏
     */
    public function showToolbar($value = true)
    {
        return $this->set('showToolbar', $value);
    }

    /**
     * 图集组件传入的排序方式 可选值: sm-ss-sss-m | sss-ss-ms-m | sms-ss-sms-m | sm-ss-sss-ss | ms-ss-sss-ss | sss-ss-sm-ss | mss-ss-ssm-ss | sss-ss-mm-ss | even-${number}-${number}
     */
    public function sortType($value = '')
    {
        return $this->set('sortType', $value);
    }

    /**
     * 图片地址，如果配置了 name，这个属性不用配置。 (图片地址，如果配置了 name，这个属性不用配置。)
     */
    public function src($value = '')
    {
        return $this->set('src', $value);
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
     * 是否静态展示表达式 (表达式，语法 `${xxx > 5}`。)
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
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 图片缩略图外层 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function thumbClassName($value = '')
    {
        return $this->set('thumbClassName', $value);
    }

    /**
     * 预览图模式 可选值: w-full | h-full | contain | cover
     */
    public function thumbMode($value = '')
    {
        return $this->set('thumbMode', $value);
    }

    /**
     * 预览图比率 可选值: 1:1 | 4:3 | 16:9
     */
    public function thumbRatio($value = '')
    {
        return $this->set('thumbRatio', $value);
    }

    /**
     * 图片标题 (支持两种语法，但是不能混着用。分别是：1. `${xxx}` 或者 `${xxx|upperCase}` 2. `<%= data.xxx %>`
更多文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template)
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 工具栏配置
     */
    public function toolbarActions($value = '')
    {
        return $this->set('toolbarActions', $value);
    }

    /**
     * 指定为图片展示类型
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
     * 是否显示表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }

    /**
     * 宽度
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }


}
