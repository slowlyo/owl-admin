<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Carousel 轮播图渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/carousel
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Carousel extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'carousel');
    }

    /**
     * 是否一直显示箭头
     */
    public function alwaysShowArrow($value = true)
    {
        return $this->set('alwaysShowArrow', $value);
    }

    /**
     * 动画类型 可选值: fade | slide | marquee
     */
    public function animation($value = '')
    {
        return $this->set('animation', $value);
    }

    /**
     * 是否自动播放
     */
    public function auto($value = true)
    {
        return $this->set('auto', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 配置控件内容
     */
    public function controls($value = '')
    {
        return $this->set('controls', $value);
    }

    /**
     *  可选值: light | dark
     */
    public function controlsTheme($value = '')
    {
        return $this->set('controlsTheme', $value);
    }

    /**
     * 轮播图方向，默认为水平方向 可选值: horizontal | vertical
     */
    public function direction($value = '')
    {
        return $this->set('direction', $value);
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
     * 动画时长
     */
    public function duration($value = '')
    {
        return $this->set('duration', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 设置高度
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
     * 自定义箭头图标
     */
    public function icons($value = '')
    {
        return $this->set('icons', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 轮播间隔时间
     */
    public function interval($value = '')
    {
        return $this->set('interval', $value);
    }

    /**
     * 配置单条呈现模板 (配置单条呈现模板)
     */
    public function itemSchema($value = '')
    {
        return $this->set('itemSchema', $value);
    }

    /**
     * 是否循环播放, 默认为 true。
     */
    public function loop($value = true)
    {
        return $this->set('loop', $value);
    }

    /**
     * 是否支持鼠标事件 默认为 true。
     */
    public function mouseEvent($value = true)
    {
        return $this->set('mouseEvent', $value);
    }

    /**
     * 多图模式配置项
     */
    public function multiple($value = true)
    {
        return $this->set('multiple', $value);
    }

    /**
     * 组件名字，这个名字可以用来定位，用于组件通信
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
     * 配置固定值
     */
    public function options($value = '')
    {
        return $this->set('options', $value);
    }

    /**
     * 占位
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
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
     * 预览图模式 可选值: contain | cover
     */
    public function thumbMode($value = '')
    {
        return $this->set('thumbMode', $value);
    }

    /**
     * 指定为轮播图类型
     */
    public function type($value = 'carousel')
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
     * 设置宽度
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }


}
