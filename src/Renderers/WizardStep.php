<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * WizardStep
 * 
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class WizardStep extends BaseRenderer
{
    public function __construct()
    {

    }

    /**
     * 按钮集合，会固定在底部显示。
     */
    public function actions($value = '')
    {
        return $this->set('actions', $value);
    }

    /**
     * 是否固定底下的按钮在底部。
     */
    public function affixFooter($value = true)
    {
        return $this->set('affixFooter', $value);
    }

    /**
     * Form 用来保存数据的 api。详情：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/index#%E8%A1%A8%E5%8D%95%E6%8F%90%E4%BA%A4
     */
    public function api($value = '')
    {
        return $this->set('api', $value);
    }

    /**
     * 设置此属性后，表单提交发送保存接口后，还会继续轮询请求该接口，直到返回 finished 属性为 true 才 结束。
     */
    public function asyncApi($value = '')
    {
        return $this->set('asyncApi', $value);
    }

    /**
     * 是否自动将第一个表单元素聚焦。
     */
    public function autoFocus($value = true)
    {
        return $this->set('autoFocus', $value);
    }

    /**
     * 表单项集合
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 轮询请求的时间间隔，默认为 3秒。设置 asyncApi 才有效
     */
    public function checkInterval($value = '')
    {
        return $this->set('checkInterval', $value);
    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 提交后清空表单
     */
    public function clearAfterSubmit($value = true)
    {
        return $this->set('clearAfterSubmit', $value);
    }

    /**
     * 提交成功后清空本地缓存
     */
    public function clearPersistDataAfterSubmit($value = true)
    {
        return $this->set('clearPersistDataAfterSubmit', $value);
    }

    /**
     * 表单项显示为几列
     */
    public function columnCount($value = '')
    {
        return $this->set('columnCount', $value);
    }

    public function data($value = '')
    {
        return $this->set('data', $value);
    }

    /**
     * 是否开启调试，开启后会在顶部实时显示表单项数据。
     */
    public function debug($value = true)
    {
        return $this->set('debug', $value);
    }

    /**
     * Debug面板配置
     */
    public function debugConfig($value = '')
    {
        return $this->set('debugConfig', $value);
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
     * Form 也可以配置 feedback。
     */
    public function feedback($value = '')
    {
        return $this->set('feedback', $value);
    }

    public function fieldSet($value = '')
    {
        return $this->set('fieldSet', $value);
    }

    /**
     * 如果决定结束的字段名不是 `finished` 请设置此属性，比如 `is_success`
     */
    public function finishedField($value = '')
    {
        return $this->set('finishedField', $value);
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
     * 如果是水平排版，这个属性可以细化水平排版的左右宽度占比。
     */
    public function horizontal($value = '')
    {
        return $this->set('horizontal', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 用来初始化表单数据
     */
    public function initApi($value = '')
    {
        return $this->set('initApi', $value);
    }

    /**
     * Form 用来获取初始数据的 api,与initApi不同的是，会一直轮询请求该接口，直到返回 finished 属性为 true 才 结束。
     */
    public function initAsyncApi($value = '')
    {
        return $this->set('initAsyncApi', $value);
    }

    /**
     * 设置了initAsyncApi以后，默认拉取的时间间隔
     */
    public function initCheckInterval($value = '')
    {
        return $this->set('initCheckInterval', $value);
    }

    /**
     * 是否初始加载
     */
    public function initFetch($value = true)
    {
        return $this->set('initFetch', $value);
    }

    /**
     * 建议改成 api 的 sendOn 属性。
     */
    public function initFetchOn($value = '')
    {
        return $this->set('initFetchOn', $value);
    }

    /**
     * 设置了initAsyncApi后，默认会从返回数据的data.finished来判断是否完成，也可以设置成其他的xxx，就会从data.xxx中获取
     */
    public function initFinishedField($value = '')
    {
        return $this->set('initFinishedField', $value);
    }

    /**
     * 设置后将轮询调用 initApi
     */
    public function interval($value = '')
    {
        return $this->set('interval', $value);
    }

    /**
     * 是否可直接跳转到该步骤，一般编辑模式需要可直接跳转查看。
     */
    public function jumpable($value = true)
    {
        return $this->set('jumpable', $value);
    }

    /**
     * 通过 JS 表达式来配置当前步骤可否被直接跳转到。
     */
    public function jumpableOn($value = '')
    {
        return $this->set('jumpableOn', $value);
    }

    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 表单label的对齐方式
     */
    public function labelAlign($value = '')
    {
        return $this->set('labelAlign', $value);
    }

    /**
     * label自定义宽度，默认单位为px
     */
    public function labelWidth($value = '')
    {
        return $this->set('labelWidth', $value);
    }

    /**
     * 消息文案配置，记住这个优先级是最低的，如果你的接口返回了 msg，接口返回的优先。
     */
    public function messages($value = '')
    {
        return $this->set('messages', $value);
    }

    /**
     * 配置表单项默认的展示方式。 可选值: normal | inline | horizontal
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

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
     * 配置容器 panel className
     */
    public function panelClassName($value = '')
    {
        return $this->set('panelClassName', $value);
    }

    /**
     * 是否开启本地缓存
     */
    public function persistData($value = '')
    {
        return $this->set('persistData', $value);
    }

    /**
     * 开启本地缓存后限制保存哪些 key
     */
    public function persistDataKeys($value = '')
    {
        return $this->set('persistDataKeys', $value);
    }

    /**
     * 禁用回车提交
     */
    public function preventEnterSubmit($value = true)
    {
        return $this->set('preventEnterSubmit', $value);
    }

    /**
     * 设置主键 id, 当设置后，检测表单是否完成时（asyncApi），只会携带此数据。
     */
    public function primaryField($value = '')
    {
        return $this->set('primaryField', $value);
    }

    /**
     * 页面离开提示，为了防止页面不小心跳转而导致表单没有保存。
     */
    public function promptPageLeave($value = true)
    {
        return $this->set('promptPageLeave', $value);
    }

    /**
     * 具体的提示信息，选填。
     */
    public function promptPageLeaveMessage($value = '')
    {
        return $this->set('promptPageLeaveMessage', $value);
    }

    public function redirect($value = '')
    {
        return $this->set('redirect', $value);
    }

    public function reload($value = '')
    {
        return $this->set('reload', $value);
    }

    /**
     * 提交完后重置表单
     */
    public function resetAfterSubmit($value = true)
    {
        return $this->set('resetAfterSubmit', $value);
    }

    /**
     * 组合校验规则，选填
     */
    public function rules($value = '')
    {
        return $this->set('rules', $value);
    }

    /**
     * 是否静默拉取
     */
    public function silentPolling($value = true)
    {
        return $this->set('silentPolling', $value);
    }

    /**
     * 展示态时的className
     */
    public function static($value = true)
    {
        return $this->set('static', $value);
    }

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

    public function staticSchema($value = '')
    {
        return $this->set('staticSchema', $value);
    }

    /**
     * 配置停止轮询的条件
     */
    public function stopAutoRefreshWhen($value = '')
    {
        return $this->set('stopAutoRefreshWhen', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 修改的时候是否直接提交表单。
     */
    public function submitOnChange($value = true)
    {
        return $this->set('submitOnChange', $value);
    }

    /**
     * 表单初始先提交一次，联动的时候有用
     */
    public function submitOnInit($value = true)
    {
        return $this->set('submitOnInit', $value);
    }

    /**
     * 默认的提交按钮名称，如果设置成空，则可以把默认按钮去掉。
     */
    public function submitText($value = '')
    {
        return $this->set('submitText', $value);
    }

    public function tabs($value = '')
    {
        return $this->set('tabs', $value);
    }

    /**
     * 默认表单提交自己会通过发送 api 保存数据，但是也可以设定另外一个 form 的 name 值，或者另外一个 `CRUD` 模型的 name 值。 如果 target 目标是一个 `Form` ，则目标 `Form` 会重新触发 `initApi` 和 `schemaApi`，api 可以拿到当前 form 数据。如果目标是一个 `CRUD` 模型，则目标模型会重新触发搜索，参数为当前 Form 数据。
     */
    public function target($value = '')
    {
        return $this->set('target', $value);
    }

    /**
     * 表单标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
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
     * 是否用 panel 包裹起来
     */
    public function wrapWithPanel($value = true)
    {
        return $this->set('wrapWithPanel', $value);
    }

}
