<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Service 服务类控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/service
 *
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self stopAutoRefreshWhen($value) 关闭轮询的条件。
 * @method self name($value) 
 * @method self silentPolling($value) 是否静默拉取
 * @method self static($value) 是否静态展示
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self api($value) 页面初始化的时候，可以设置一个 API 让其取拉取，发送数据会携带当前 data 数据（包含地址栏参数），获取得数据会合并到 data 中，供组件内使用。
 * @method self dataProvider($value) 通过调用外部函数来获取数据
 * @method self schemaApi($value) 用来获取远程 Schema 的 api
 * @method self visible($value) 是否显示
 * @method self onEvent($value) 事件动作配置
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticSchema($value) 
 * @method self visibleOn($value) 是否显示表达式
 * @method self interval($value) 是否轮询拉取
 * @method self initFetchSchema($value) 是否默认加载 schemaApi
 * @method self initFetchSchemaOn($value) 用表达式来配置。
 * @method self messages($value) 
 * @method self disabled($value) 是否禁用
 * @method self staticOn($value) 是否静态展示表达式
 * @method self fetchOn($value) 
 * @method self initFetch($value) 是否默认就拉取？
 * @method self initFetchOn($value) 是否默认就拉取？通过表达式来决定.
 * @method self className($value) 容器 css 类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self ws($value) WebScocket 地址，用于实时获取数据
 * @method self loadingConfig($value) 
 * @method self hidden($value) 是否隐藏
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self type($value) 指定为 Service 数据拉取控件。
 * @method self body($value) 内容区域
 */
class Service extends BaseRenderer
{
    public string $type = 'service';
}
