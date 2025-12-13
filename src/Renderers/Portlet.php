<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Portlet
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Portlet extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'portlet');
    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 内容类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function contentClassName($value = '')
    {
        return $this->set('contentClassName', $value);
    }

    /**
     * 标题右侧的描述 (支持两种语法，但是不能混着用。分别是：1. `${xxx}` 或者 `${xxx|upperCase}` 2. `<%= data.xxx %>`
更多文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template)
     */
    public function description($value = '')
    {
        return $this->set('description', $value);
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
     * header和内容是否展示分割线
     */
    public function divider($value = true)
    {
        return $this->set('divider', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
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
     * 隐藏头部
     */
    public function hideHeader($value = true)
    {
        return $this->set('hideHeader', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 链接外层类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function linksClassName($value = '')
    {
        return $this->set('linksClassName', $value);
    }

    /**
     * 卡片是否只有在点开的时候加载？
     */
    public function mountOnEnter($value = true)
    {
        return $this->set('mountOnEnter', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 是否支持溢出滚动
     */
    public function scrollable($value = true)
    {
        return $this->set('scrollable', $value);
    }

    /**
     * 关联已有数据，选项卡直接根据目标数据重复。
     */
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

    /**
     * 
     */
    public function staticSchema($value = '')
    {
        return $this->set('staticSchema', $value);
    }

    /**
     * 自定义样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 选项卡成员。当配置了 source 时，选项卡成员，将会根据目标数据进行重复。
     */
    public function tabs($value = '')
    {
        return $this->set('tabs', $value);
    }

    /**
     * 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function tabsClassName($value = '')
    {
        return $this->set('tabsClassName', $value);
    }

    /**
     * 展示形式 可选值:  | line | card | radio | vertical | tiled
     */
    public function tabsMode($value = '')
    {
        return $this->set('tabsMode', $value);
    }

    /**
     * 可以在右侧配置点其他功能按钮。不会随着tab切换
     */
    public function toolbar($value = '')
    {
        return $this->set('toolbar', $value);
    }

    /**
     * 指定为 portlet 类型
     */
    public function type($value = 'portlet')
    {
        return $this->set('type', $value);
    }

    /**
     * 卡片隐藏的时候是否销毁卡片内容
     */
    public function unmountOnExit($value = true)
    {
        return $this->set('unmountOnExit', $value);
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
     * 是否显示表达式
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
