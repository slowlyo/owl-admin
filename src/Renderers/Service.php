<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Service 功能型容器</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/service
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self body($value) 内容容器
 * @method self api($value) 初始化数据域接口地址
 * @method self ws($value) WebScocket 地址
 * @method self dataProvider($value) 数据获取函数
 * @method self initFetch($value) 是否默认拉取
 * @method self schemaApi($value) 用来获取远程 Schema 接口地址
 * @method self initFetchSchema($value) 是否默认拉取 Schema
 * @method self messages($value) 消息提示覆写，默认消息读取的是接口返回的 toast 提示文字，但是在此可以覆写它。
 * @method self interval($value) 轮询时间间隔，单位 ms(最低 1000)
 * @method self silentPolling($value) 配置轮询时是否显示加载动画
 * @method self stopAutoRefreshWhen($value) 配置停止轮询的条件
 */
class Service extends BaseRenderer
{
    public string $type = 'service';
}
