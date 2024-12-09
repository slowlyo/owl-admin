<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * amis Page 渲染器。详情请见：https://aisuda.bce.baidu.com/amis/zh-CN/components/page
 *
 * @author  slowlyo
 * @version 6.10.0
 */
class Page extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'page');
    }

    /**
     * 边栏区域 (边栏区域)
     */
    public function aside($value = '')
    {
        return $this->set('aside', $value);
    }

    /**
     * 边栏区 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function asideClassName($value = '')
    {
        return $this->set('asideClassName', $value);
    }

    /**
     * 边栏最小宽度
     */
    public function asideMaxWidth($value = '')
    {
        return $this->set('asideMaxWidth', $value);
    }

    /**
     * 边栏最小宽度
     */
    public function asideMinWidth($value = '')
    {
        return $this->set('asideMinWidth', $value);
    }

    /**
     * 边栏是否允许拖动
     */
    public function asideResizor($value = true)
    {
        return $this->set('asideResizor', $value);
    }

    /**
     * 边栏内容是否粘住，即不跟随滚动。
     */
    public function asideSticky($value = true)
    {
        return $this->set('asideSticky', $value);
    }

    /**
     * 内容区域 (内容区域)
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 内容区 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function bodyClassName($value = '')
    {
        return $this->set('bodyClassName', $value);
    }

    /**
     * 配置容器 className (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 自定义页面级别样式表
     */
    public function css($value = '')
    {
        return $this->set('css', $value);
    }

    /**
     * css 变量
     */
    public function cssVars($value = '')
    {
        return $this->set('cssVars', $value);
    }

    /**
     * 页面级别的初始数据 (初始数据，设置得值可用于组件内部模板使用。)
     */
    public function data($value = '')
    {
        return $this->set('data', $value);
    }

    /**
     *
     */
    public function definitions($value = '')
    {
        return $this->set('definitions', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式 (表达式，语法 `data.xxx > 5`。)
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
     * 配置 header 容器 className (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function headerClassName($value = '')
    {
        return $this->set('headerClassName', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `data.xxx > 5`。)
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
     * 页面初始化的时候，可以设置一个 API 让其取拉取，发送数据会携带当前 data 数据（包含地址栏参数），获取得数据会合并到 data 中，供组件内使用。 (页面初始化的时候，可以设置一个 API 让其取拉取，发送数据会携带当前 data 数据（包含地址栏参数），获取得数据会合并到 data 中，供组件内使用。)
     */
    public function initApi($value = '')
    {
        return $this->set('initApi', $value);
    }

    /**
     * 是否默认就拉取？
     */
    public function initFetch($value = true)
    {
        return $this->set('initFetch', $value);
    }

    /**
     * 是否默认就拉取表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function initFetchOn($value = '')
    {
        return $this->set('initFetchOn', $value);
    }

    /**
     * 配置轮询间隔，配置后 initApi 将轮询加载。
     */
    public function interval($value = '')
    {
        return $this->set('interval', $value);
    }

    /**
     *
     */
    public function loadingConfig($value = '')
    {
        return $this->set('loadingConfig', $value);
    }

    /**
     * 消息文案配置，记住这个优先级是最低的，如果你的接口返回了 msg，接口返回的优先。
     */
    public function messages($value = '')
    {
        return $this->set('messages', $value);
    }

    /**
     * 移动端下的样式表
     */
    public function mobileCSS($value = '')
    {
        return $this->set('mobileCSS', $value);
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
     * 下拉刷新配置
     */
    public function pullRefresh($value = '')
    {
        return $this->set('pullRefresh', $value);
    }

    /**
     * 默认不设置自动感觉内容来决定要不要展示这些区域 如果配置了，以配置为主。
     */
    public function regions($value = '')
    {
        return $this->set('regions', $value);
    }

    /**
     * 页面描述, 标题旁边会出现个小图标，放上去会显示这个属性配置的内容。 (页面描述, 标题旁边会出现个小图标，放上去会显示这个属性配置的内容。)
     */
    public function remark($value = '')
    {
        return $this->set('remark', $value);
    }

    /**
     * 是否显示错误信息，默认是显示的。
     */
    public function showErrorMsg($value = true)
    {
        return $this->set('showErrorMsg', $value);
    }

    /**
     * 是否要静默加载，也就是说不显示进度
     */
    public function silentPolling($value = true)
    {
        return $this->set('silentPolling', $value);
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
     * 是否静态展示表达式 (表达式，语法 `data.xxx > 5`。)
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
     * 配置停止轮询的条件。 (表达式，语法 `data.xxx > 5`。)
     */
    public function stopAutoRefreshWhen($value = '')
    {
        return $this->set('stopAutoRefreshWhen', $value);
    }

    /**
     * 自定义样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 页面副标题
     */
    public function subTitle($value = '')
    {
        return $this->set('subTitle', $value);
    }

    /**
     *
     */
    public function testIdBuilder($value = '')
    {
        return $this->set('testIdBuilder', $value);
    }

    /**
     *
     */
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 页面标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 页面顶部区域，当存在 title 时在右上角显示。 (页面顶部区域，当存在 title 时在右上角显示。)
     */
    public function toolbar($value = '')
    {
        return $this->set('toolbar', $value);
    }

    /**
     * 配置 toolbar 容器 className (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function toolbarClassName($value = '')
    {
        return $this->set('toolbarClassName', $value);
    }

    /**
     * 指定为 page 渲染器。
     */
    public function type($value = 'page')
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
     * 是否显示表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
