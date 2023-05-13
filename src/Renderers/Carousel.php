<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Carousel 轮播图渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/carousel
 * 
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
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
     * 动画类型 可选值: fade | slide
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
     * 容器 css 类名
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
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式
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
     * 是否隐藏表达式
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
     * 配置单条呈现模板
     */
    public function itemSchema($value = '')
    {
        return $this->set('itemSchema', $value);
    }

    /**
     * 多图模式配置项
     */
    public function multiple($value = '')
    {
        return $this->set('multiple', $value);
    }

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
     * 静态展示表单项类名
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 静态展示表单项Value类名
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 静态展示表单项Label类名
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 是否静态展示表达式
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
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式
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
