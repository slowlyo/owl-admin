<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 进度展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/progress
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Progress extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'progress');
$this->set('mode', 'line');
    }

    /**
     * 是否显示动画（只有在开启的时候才能看出来）
     */
    public function animate($value = true)
    {
        return $this->set('animate', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
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
     * 仪表盘进度条缺口角度，可取值 0 ~ 295
     */
    public function gapDegree($value = '')
    {
        return $this->set('gapDegree', $value);
    }

    /**
     * 仪表盘进度条缺口位置 可选值: top | bottom | left | right
     */
    public function gapPosition($value = '')
    {
        return $this->set('gapPosition', $value);
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
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 配置不同的值段，用不同的样式提示用户 (配置不同的值段，用不同的样式提示用户)
     */
    public function map($value = '')
    {
        return $this->set('map', $value);
    }

    /**
     * 进度条类型 可选值: line | circle | dashboard
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 关联字段名
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
     * 占位符
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 进度条 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function progressClassName($value = '')
    {
        return $this->set('progressClassName', $value);
    }

    /**
     * 是否显示值
     */
    public function showLabel($value = true)
    {
        return $this->set('showLabel', $value);
    }

    /**
     * 是否显示阈值数值
     */
    public function showThresholdText($value = true)
    {
        return $this->set('showThresholdText', $value);
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
     * 是否显示背景间隔
     */
    public function stripe($value = true)
    {
        return $this->set('stripe', $value);
    }

    /**
     * 进度条线的宽度
     */
    public function strokeWidth($value = '')
    {
        return $this->set('strokeWidth', $value);
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
     * 阈值
     */
    public function threshold($value = '')
    {
        return $this->set('threshold', $value);
    }

    /**
     * 指定为模板渲染器。文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template
     */
    public function type($value = 'progress')
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
     * 进度值
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
    }

    /**
     * 内容的模板函数
     */
    public function valueTpl($value = '')
    {
        return $this->set('valueTpl', $value);
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
