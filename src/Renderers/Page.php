<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Page 页面</b> <br/>
 * Page 组件是 amis 页面 JSON 配置中顶级容器组件，是整个页面配置的入口组件。<br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/page
 *
 * @method self title($value) 页面标题
 * @method self subTitle($value) 页面副标题
 * @method self remark($value) 标题附近会出现一个提示图标，鼠标放上去会提示该内容。
 * @method self aside($value) 往页面的边栏区域加内容
 * @method self asideResizor($value) 页面的边栏区域宽度是否可调整
 * @method self asideMinWidth($value) 页面边栏区域的最小宽度
 * @method self asideMaxWidth($value) 页面边栏区域的最大宽度
 * @method self asideSticky($value = true) 用来控制边栏固定与否
 * @method self toolbar($value) 往页面的右上角加内容，需要注意的是，当有 title 时，该区域在右上角，没有时该区域在顶部
 * @method self body($value) 往页面的内容区域加内容
 * @method self data($v)
 * @method self className($value) 外层 dom 类名
 * @method self cssVars($value) 自定义 CSS 变量
 * @method self toolbarClassName($value = 'v-middle wrapper text-right bg-light b-b') Toolbar dom 类名
 * @method self bodyClassName($value = 'wrapper') Body dom 类名
 * @method self asideClassName($value = 'w page-aside-region bg-auto') Aside dom 类名
 * @method self headerClassName($value = 'bg-light b-b wrapper') Header 区域 dom 类名
 * @method self initApi($value) Page 用来获取初始数据的 api。返回的数据可以整个 page 级别使用。
 * @method self initFetch($value = true) 是否起始拉取 initApi
 * @method self initFetchOn($value) 是否起始拉取 initApi, 通过表达式配置
 * @method self interval($value = 3000) 刷新时间(最小 1000)
 * @method self silentPolling($value = true) 配置刷新时是否显示加载动画
 * @method self stopAutoRefreshWhen($value) 通过表达式来配置停止刷新的条件
 * @method self pullRefresh($value) 下拉刷新配置（仅用于移动端）
 * @method self css($value)
 */
class Page extends BaseRenderer
{
    public string $type = 'page';

    public string $view = 'slow-admin::index';

    public function setView($view): static
    {
        $view && $this->view = $view;

        return $this;
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view($this->view, ['adminJson' => $this->toJson()]);
    }
}
