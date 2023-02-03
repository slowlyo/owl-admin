<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * amis Page 渲染器。详情请见：https://aisuda.bce.baidu.com/amis/zh-CN/components/page
 *
 * @method self aside($value) 边栏区域
 * @method self asideResizor($value) 边栏是否允许拖动
 * @method self toolbar($value) 页面顶部区域，当存在 title 时在右上角显示。
 * @method self onEvent($value) 事件动作配置
 * @method self staticSchema($value) 
 * @method self asideSticky($value) 边栏内容是否粘住，即不跟随滚动。
 * @method self asideMaxWidth($value) 边栏最小宽度
 * @method self initFetchOn($value) 是否默认就拉取表达式
 * @method self definitions($value) 
 * @method self interval($value) 配置轮询间隔，配置后 initApi 将轮询加载。
 * @method self stopAutoRefreshWhen($value) 配置停止轮询的条件。
 * @method self type($value) 指定为 page 渲染器。
 * @method self title($value) 页面标题
 * @method self mobileCSS($value) 移动端下的样式表
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self asideMinWidth($value) 边栏最小宽度
 * @method self css($value) 自定义页面级别样式表
 * @method self data($value) 页面级别的初始数据
 * @method self initApi($value) 页面初始化的时候，可以设置一个 API 让其取拉取，发送数据会携带当前 data 数据（包含地址栏参数），获取得数据会合并到 data 中，供组件内使用。
 * @method self initFetch($value) 是否默认就拉取？
 * @method self disabled($value) 是否禁用
 * @method self visible($value) 是否显示
 * @method self name($value) 
 * @method self silentPolling($value) 是否要静默加载，也就是说不显示进度
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self messages($value) 
 * @method self toolbarClassName($value) 配置 toolbar 容器 className
 * @method self style($value) 自定义样式
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self body($value) 内容区域
 * @method self showErrorMsg($value) 是否显示错误信息，默认是显示的。
 * @method self cssVars($value) css 变量
 * @method self regions($value) 默认不设置自动感觉内容来决定要不要展示这些区域 如果配置了，以配置为主。
 * @method self loadingConfig($value) 
 * @method self static($value) 是否静态展示
 * @method self pullRefresh($value) 下拉刷新配置
 * @method self bodyClassName($value) 内容区 css 类名
 * @method self asideClassName($value) 边栏区 css 类名
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self remark($value) 页面描述, 标题旁边会出现个小图标，放上去会显示这个属性配置的内容。
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self subTitle($value) 页面副标题
 * @method self headerClassName($value) 配置 header 容器 className
 * @method self className($value) 配置容器 className
 * @method self hidden($value) 是否隐藏
 */
class Page extends BaseRenderer
{
    public string $type = 'page';
}
