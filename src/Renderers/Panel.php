<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Panel渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/panel
 *
 * @author  slowlyo
 * @version 6.1.0
 */
class Panel extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'panel');
    }

    /**
     * 按钮集合
     */
    public function actions($value = '')
    {
        return $this->set('actions', $value);
    }

    /**
     * 按钮集合外层类名
     */
    public function actionsClassName($value = '')
    {
        return $this->set('actionsClassName', $value);
    }

    /**
     * 固定底部, 想要把按钮固定在底部的时候配置。
     */
    public function affixFooter($value = '')
    {
        return $this->set('affixFooter', $value);
    }

    /**
     * 内容区域
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 配置 Body 容器 className
     */
    public function bodyClassName($value = '')
    {
        return $this->set('bodyClassName', $value);
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
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 底部内容区域
     */
    public function footer($value = '')
    {
        return $this->set('footer', $value);
    }

    /**
     * 配置 footer 容器 className
     */
    public function footerClassName($value = '')
    {
        return $this->set('footerClassName', $value);
    }

    /**
     * footer 和 actions 外层 div 类名。
     */
    public function footerWrapClassName($value = '')
    {
        return $this->set('footerWrapClassName', $value);
    }

    /**
     * 头部内容, 和 title 二选一。
     */
    public function header($value = '')
    {
        return $this->set('header', $value);
    }

    /**
     * 配置 header 容器 className
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
     * 如果是水平排版，这个属性可以细化水平排版的左右宽度占比。
     */
    public function subFormHorizontal($value = '')
    {
        return $this->set('subFormHorizontal', $value);
    }

    /**
     * 配置子表单项默认的展示方式。 可选值: normal | inline | horizontal
     */
    public function subFormMode($value = '')
    {
        return $this->set('subFormMode', $value);
    }

    /**
     * Panel 标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 指定为Panel渲染器。
     */
    public function type($value = 'panel')
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
     * 是否显示表达式
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
