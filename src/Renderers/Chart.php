<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Chart 图表</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/chart
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self body($value) 内容容器
 * @method self api($value) 配置项接口地址
 * @method self source($value) 通过数据映射获取数据链中变量值作为配置
 * @method self initFetch($value) 组件初始化时，是否请求接口
 * @method self interval($value) 刷新时间(最小 1000)
 * @method self config($value) 设置 eschars 的配置项, 当为string的时候可以设置 function 等配置项
 * @method self style($value) 设置根元素的 style
 * @method self width($value) 设置根元素的宽度
 * @method self height($value) 设置根元素的高度
 * @method self replaceChartOption($value) 每次更新是完全覆盖配置项还是追加？
 * @method self trackExpression($value) 当这个表达式的值有变化时更新图表
 * @method self dataFilter($value) 自定义 echart config 转换，函数签名：function(config, echarts, data) '{return config;}' 配置时直接写函数体。其中 config 是当前 echart 配置，echarts 就是 echarts 对象，data 为上下文数据。
 */
class Chart extends BaseRenderer
{
    public string $type = 'chart';
}
