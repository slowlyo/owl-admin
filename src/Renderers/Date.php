<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Date 展示渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/date
 *
 * @author  slowlyo
 * @version 3.5.2
 */
class Date extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'date');
    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
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
     * 展示的时间格式，参考 moment 中的格式说明。（新：同format）
     */
    public function displayFormat($value = '')
    {
        return $this->set('displayFormat', $value);
    }

    /**
     * 时区
     */
    public function displayTimeZone($value = '')
    {
        return $this->set('displayTimeZone', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 展示的时间格式，参考 moment 中的格式说明。
     */
    public function format($value = '')
    {
        return $this->set('format', $value);
    }

    /**
     * 显示成相对时间，比如1分钟前
     */
    public function fromNow($value = true)
    {
        return $this->set('fromNow', $value);
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
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 占位符
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
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
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 指定为日期展示类型 可选值: date | datetime | time | static-date | static-datetime | static-time
     */
    public function type($value = '')
    {
        return $this->set('type', $value);
    }

    /**
     * 更新频率， 默认为1分钟
     */
    public function updateFrequency($value = '')
    {
        return $this->set('updateFrequency', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 值的时间格式，参考 moment 中的格式说明。
     */
    public function valueFormat($value = '')
    {
        return $this->set('valueFormat', $value);
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
