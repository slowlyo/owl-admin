<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Timeline
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Timeline extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'timeline');
    }

    /**
     * 卡片展示配置，如果传入则将items数据传入cardSchema中循环渲染，itemTitleSchema、titleClassName、detailClassName将不生效。配置后 timeline item中的数据都将可以在cardSchema中通过数据方式引用。如果子节点也配置了cardSchema，则子节点的cardSchema优先级高于timeline的cardSchema (Card 卡片渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/card)
     */
    public function cardSchema($value = '')
    {
        return $this->set('cardSchema', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 节点详情的CSS类名
     */
    public function detailClassName($value = '')
    {
        return $this->set('detailClassName', $value);
    }

    /**
     * 展示方向 可选值: horizontal | vertical
     */
    public function direction($value = '')
    {
        return $this->set('direction', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式 (表达式，语法 `${xxx > 5}`。)
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
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 图标的CSS类名
     */
    public function iconClassName($value = '')
    {
        return $this->set('iconClassName', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 节点title自定一展示模板 (节点title自定一展示模板)
     */
    public function itemTitleSchema($value = '')
    {
        return $this->set('itemTitleSchema', $value);
    }

    /**
     * 节点数据
     */
    public function items($value = '')
    {
        return $this->set('items', $value);
    }

    /**
     * 文字相对于时间轴展示方向 可选值: left | right | top | bottom | alternate
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 节点倒序
     */
    public function reverse($value = true)
    {
        return $this->set('reverse', $value);
    }

    /**
     * API 或 数据映射
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
     * 是否静态展示表达式 (表达式，语法 `${xxx > 5}`。)
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
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 
     */
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 节点时间的CSS类名
     */
    public function timeClassName($value = '')
    {
        return $this->set('timeClassName', $value);
    }

    /**
     * 节点标题的CSS类名
     */
    public function titleClassName($value = '')
    {
        return $this->set('titleClassName', $value);
    }

    /**
     * 指定为 Timeline 时间轴渲染器
     */
    public function type($value = 'timeline')
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
     * 是否显示表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
