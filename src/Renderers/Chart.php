<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Chart 图表渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/carousel
 *
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self dataFilter($value) 
 * @method self unMountOnHidden($value) 不可见的时候隐藏
 * @method self disabled($value) 是否禁用
 * @method self hidden($value) 是否隐藏
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self type($value) 指定为 chart 类型
 * @method self name($value) 
 * @method self style($value) style样式
 * @method self clickAction($value) 点击行为配置，可以用来满足下钻操作等。
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticSchema($value) 
 * @method self trackExpression($value) 跟踪表达式，如果这个表达式的运行结果发生变化了，则会更新 Echart，当 config 中用了数据映射时有用。
 * @method self width($value) 宽度设置
 * @method self height($value) 高度设置
 * @method self source($value) 
 * @method self static($value) 是否静态展示
 * @method self initFetch($value) 是否初始加载。
 * @method self initFetchOn($value) 是否初始加载用表达式来配置
 * @method self replaceChartOption($value) 默认配置时追加的，如果更新配置想完全替换配置请配置为 true.
 * @method self className($value) 容器 css 类名
 * @method self visible($value) 是否显示
 * @method self api($value) 图表配置接口
 * @method self config($value) 配置echart的config，支持数据映射。如果用了数据映射，为了同步更新，请设置 trackExpression
 * @method self mapName($value) 地图名称
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self onEvent($value) 事件动作配置
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self chartTheme($value) Chart 主题配置
 * @method self disableDataMapping($value) 默认开启 Config 中的数据映射，如果想关闭，请开启此功能。
 * @method self mapURL($value) 获取 geo json 文件的地址
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self loadBaiduMap($value) 加载百度地图
 * @method self interval($value) 刷新时间
 */
class Chart extends BaseRenderer
{
    public string $type = 'chart';
}
