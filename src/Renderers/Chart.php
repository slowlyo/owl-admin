<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Chart 图表渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/carousel
 * 
 * @author slowlyo
 * @version v3.1.0
 * @since 2023-06-03
 */
class Chart extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'chart');

    }

    /**
     * 图表配置接口
     */
    public function api($value = '')
    {
        return $this->set('api', $value);
    }

    /**
     * Chart 主题配置
     */
    public function chartTheme($value = '')
    {
        return $this->set('chartTheme', $value);
    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 点击行为配置，可以用来满足下钻操作等。
     */
    public function clickAction($value = '')
    {
        return $this->set('clickAction', $value);
    }

    /**
     * 配置echart的config，支持数据映射。如果用了数据映射，为了同步更新，请设置 trackExpression
     */
    public function config($value = '')
    {
        return $this->set('config', $value);
    }

    public function dataFilter($value = '')
    {
        return $this->set('dataFilter', $value);
    }

    /**
     * 默认开启 Config 中的数据映射，如果想关闭，请开启此功能。
     */
    public function disableDataMapping($value = true)
    {
        return $this->set('disableDataMapping', $value);
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
     * 高度设置
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
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 是否初始加载。
     */
    public function initFetch($value = true)
    {
        return $this->set('initFetch', $value);
    }

    /**
     * 是否初始加载用表达式来配置
     */
    public function initFetchOn($value = '')
    {
        return $this->set('initFetchOn', $value);
    }

    /**
     * 刷新时间
     */
    public function interval($value = '')
    {
        return $this->set('interval', $value);
    }

    /**
     * 加载百度地图
     */
    public function loadBaiduMap($value = true)
    {
        return $this->set('loadBaiduMap', $value);
    }

    /**
     * 地图名称
     */
    public function mapName($value = '')
    {
        return $this->set('mapName', $value);
    }

    /**
     * 获取 geo json 文件的地址
     */
    public function mapURL($value = '')
    {
        return $this->set('mapURL', $value);
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
     * 默认配置时追加的，如果更新配置想完全替换配置请配置为 true.
     */
    public function replaceChartOption($value = true)
    {
        return $this->set('replaceChartOption', $value);
    }

    public function source($value = '')
    {
        return $this->set('source', $value);
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
     * style样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 跟踪表达式，如果这个表达式的运行结果发生变化了，则会更新 Echart，当 config 中用了数据映射时有用。
     */
    public function trackExpression($value = '')
    {
        return $this->set('trackExpression', $value);
    }

    /**
     * 指定为 chart 类型
     */
    public function type($value = 'chart')
    {
        return $this->set('type', $value);
    }

    /**
     * 不可见的时候隐藏
     */
    public function unMountOnHidden($value = true)
    {
        return $this->set('unMountOnHidden', $value);
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
     * 宽度设置
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }

}
