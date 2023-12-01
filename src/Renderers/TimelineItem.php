<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * TimelineItem
 *
 * @author  slowlyo
 * @version v3.6.1
 */
class TimelineItem extends BaseRenderer
{
    public function __construct()
    {


    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 时间点圆圈颜色
     */
    public function color($value = '')
    {
        return $this->set('color', $value);
    }

    /**
     * 详细内容
     */
    public function detail($value = '')
    {
        return $this->set('detail', $value);
    }

    /**
     * 节点详情的CSS类名（优先级高于统一配置的detailClassName）
     */
    public function detailClassName($value = '')
    {
        return $this->set('detailClassName', $value);
    }

    /**
     * detail折叠时文案
     */
    public function detailCollapsedText($value = '')
    {
        return $this->set('detailCollapsedText', $value);
    }

    /**
     * detail展开时文案
     */
    public function detailExpandedText($value = '')
    {
        return $this->set('detailExpandedText', $value);
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
     * 图标
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
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
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
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
     * 时间点
     */
    public function time($value = '')
    {
        return $this->set('time', $value);
    }

    /**
     * 节点时间的CSS类名（优先级高于统一配置的timeClassName）
     */
    public function timeClassName($value = '')
    {
        return $this->set('timeClassName', $value);
    }

    /**
     * 时间节点标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 节点标题的CSS类名（优先级高于统一配置的titleClassName）
     */
    public function titleClassName($value = '')
    {
        return $this->set('titleClassName', $value);
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
