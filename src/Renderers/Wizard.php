<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 表单向导 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/wizard
 *
 * @author  slowlyo
 * @version 3.5.2
 */
class Wizard extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'wizard');
    }

    /**
     * 配置按钮 className
     */
    public function actionClassName($value = '')
    {
        return $this->set('actionClassName', $value);
    }

    /**
     * 完成按钮的文字描述
     */
    public function actionFinishLabel($value = '')
    {
        return $this->set('actionFinishLabel', $value);
    }

    /**
     * 下一步按钮的文字描述
     */
    public function actionNextLabel($value = '')
    {
        return $this->set('actionNextLabel', $value);
    }

    /**
     * 下一步并且保存按钮的文字描述
     */
    public function actionNextSaveLabel($value = '')
    {
        return $this->set('actionNextSaveLabel', $value);
    }

    /**
     * 上一步按钮的文字描述
     */
    public function actionPrevLabel($value = '')
    {
        return $this->set('actionPrevLabel', $value);
    }

    /**
     * 是否将底部按钮固定在底部。
     */
    public function affixFooter($value = '')
    {
        return $this->set('affixFooter', $value);
    }

    /**
     * Wizard 用来保存数据的 api。 [详情](https://baidu.github.io/amis/docs/api#wizard)
     */
    public function api($value = '')
    {
        return $this->set('api', $value);
    }

    /**
     * 表单区域css类
     */
    public function bodyClassName($value = '')
    {
        return $this->set('bodyClassName', $value);
    }

    /**
     * 是否合并后再提交
     */
    public function bulkSubmit($value = true)
    {
        return $this->set('bulkSubmit', $value);
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
     * 底部操作栏的css类
     */
    public function footerClassName($value = '')
    {
        return $this->set('footerClassName', $value);
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
     * Wizard 用来获取初始数据的 api。
     */
    public function initApi($value = '')
    {
        return $this->set('initApi', $value);
    }

    /**
     *
     */
    public function loadingConfig($value = '')
    {
        return $this->set('loadingConfig', $value);
    }

    /**
     * 展示模式 可选值: vertical | horizontal
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     *
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
     * 是否为只读模式。
     */
    public function readOnly($value = true)
    {
        return $this->set('readOnly', $value);
    }

    /**
     * 保存完后，可以指定跳转地址，支持相对路径和组内绝对路径，同时可以通过 $xxx 使用变量
     */
    public function redirect($value = '')
    {
        return $this->set('redirect', $value);
    }

    /**
     *
     */
    public function reload($value = '')
    {
        return $this->set('reload', $value);
    }

    /**
     *
     */
    public function startStep($value = '')
    {
        return $this->set('startStep', $value);
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
     * step + body区域css类
     */
    public function stepClassName($value = '')
    {
        return $this->set('stepClassName', $value);
    }

    /**
     *
     */
    public function steps($value = '')
    {
        return $this->set('steps', $value);
    }

    /**
     * 步骤条区域css类
     */
    public function stepsClassName($value = '')
    {
        return $this->set('stepsClassName', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 默认表单提交自己会通过发送 api 保存数据，但是也可以设定另外一个 form 的 name 值，或者另外一个 `CRUD` 模型的 name 值。 如果 target 目标是一个 `Form` ，则目标 `Form` 会重新触发 `initApi` 和 `schemaApi`，api 可以拿到当前 form 数据。如果目标是一个 `CRUD` 模型，则目标模型会重新触发搜索，参数为当前 Form 数据。
     */
    public function target($value = '')
    {
        return $this->set('target', $value);
    }

    /**
     * 指定为表单向导
     */
    public function type($value = 'wizard')
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

    /**
     * 是否用panel包裹
     */
    public function wrapWithPanel($value = true)
    {
        return $this->set('wrapWithPanel', $value);
    }


}
