<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * WizardStep
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class WizardStep extends BaseRenderer
{

    /**
     * 按钮集合，会固定在底部显示。
     */
    public function actions($value = '')
    {
        return $this->set('actions', $value);
    }

    /**
     * 是否固底
     */
    public function affixFooter($value = true)
    {
        return $this->set('affixFooter', $value);
    }

    /**
     * 当前步骤用来保存数据的 api。 (当前步骤用来保存数据的 api。)
     */
    public function api($value = '')
    {
        return $this->set('api', $value);
    }

    /**
     * 设置此属性后，表单提交发送保存接口后，还会继续轮询请求该接口，直到返回 finished 属性为 true 才 结束。 (设置此属性后，表单提交发送保存接口后，还会继续轮询请求该接口，直到返回 finished 属性为 true 才 结束。)
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
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
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

    /**
     * 页面级别的初始数据 (初始数据，设置得值可用于组件内部模板使用。)
     */
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
     * 描述
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
     * Form 也可以配置 feedback。
     */
    public function feedback($value = '')
    {
        return $this->set('feedback', $value);
    }

    /**
     * 
     */
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
     * 是否隐藏表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 当配置为水平布局的时候，用来配置具体的左右分配。 (当配置为水平布局的时候，用来配置具体的左右分配。)
     */
    public function horizontal($value = '')
    {
        return $this->set('horizontal', $value);
    }

    /**
     * 图标
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 当前步骤用来获取初始数据的 api (当前步骤用来获取初始数据的 api)
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
     * 是否默认就拉取？
     */
    public function initFetch($value = true)
    {
        return $this->set('initFetch', $value);
    }

    /**
     * 是否默认就拉取表达式 (表达式，语法 `${xxx > 5}`。)
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
     * 配置轮询间隔，配置后 initApi 将轮询加载。
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
     * 通过 JS 表达式来配置当前步骤可否被直接跳转到。 (表达式，语法 `${xxx > 5}`。)
     */
    public function jumpableOn($value = '')
    {
        return $this->set('jumpableOn', $value);
    }

    /**
     * 描述标题, 当值为 false 时不展示
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 描述标题 (描述标题) 可选值: right | left | top | inherit
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
     * 配置当前表单项展示模式 可选值: normal | inline | horizontal
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
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
     * 设置ID字段名 作用同keyFiled 兼容原CURD属性
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

    /**
     * 保存完后，可以指定跳转地址，支持相对路径和组内绝对路径，同时可以通过 $xxx 使用变量
     */
    public function redirect($value = '')
    {
        return $this->set('redirect', $value);
    }

    /**
     * 配置刷新动作，这个动作通常在完成渲染器本省的固定动作后出发。一般用来配置目标组件的 name 属性。多个目标可以用逗号隔开。当目标是 windows 时表示刷新整个页面。刷新目标的同时还支持传递参数如： `foo?a=${a}&b=${b},boo?c=${c}`
     */
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
     * 是否要静默加载，也就是说不显示进度
     */
    public function silentPolling($value = true)
    {
        return $this->set('silentPolling', $value);
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
     * 配置停止轮询的条件。 (表达式，语法 `${xxx > 5}`。)
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
     * 子标题
     */
    public function subTitle($value = '')
    {
        return $this->set('subTitle', $value);
    }

    /**
     * 当修改完的时候是否提交表单。
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

    /**
     * 选项卡成员。当配置了 source 时，选项卡成员，将会根据目标数据进行重复。
     */
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
     * 标题
     */
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 默认值，切记只能是静态值，不支持取变量，跟数据关联是通过设置 name 属性来实现的。
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
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

    /**
     * 是否用panel包裹
     */
    public function wrapWithPanel($value = true)
    {
        return $this->set('wrapWithPanel', $value);
    }


}
