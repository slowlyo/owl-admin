<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Form 表单渲染器。说明：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/index
 *
 * @method self staticOn($value) 
 * @method self persistData($value) 是否开启本地缓存
 * @method self initFetch($value) 是否初始加载
 * @method self initFetchOn($value) 建议改成 api 的 sendOn 属性。
 * @method self messages($value) 消息文案配置，记住这个优先级是最低的，如果你的接口返回了 msg，接口返回的优先。
 * @method self target($value) 默认表单提交自己会通过发送 api 保存数据，但是也可以设定另外一个 form 的 name 值，或者另外一个 `CRUD` 模型的 name 值。 如果 target 目标是一个 `Form` ，则目标 `Form` 会重新触发 `initApi` 和 `schemaApi`，api 可以拿到当前 form 数据。如果目标是一个 `CRUD` 模型，则目标模型会重新触发搜索，参数为当前 Form 数据。
 * @method self wrapWithPanel($value) 是否用 panel 包裹起来
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self actions($value) 按钮集合，会固定在底部显示。
 * @method self data($value) 
 * @method self promptPageLeaveMessage($value) 具体的提示信息，选填。
 * @method self className($value) 容器 css 类名
 * @method self disabledOn($value) 是否禁用表达式
 * @method self tabs($value) 
 * @method self fieldSet($value) 
 * @method self asyncApi($value) 设置此属性后，表单提交发送保存接口后，还会继续轮询请求该接口，直到返回 finished 属性为 true 才 结束。
 * @method self resetAfterSubmit($value) 提交完后重置表单
 * @method self staticSchema($value) 
 * @method self clearPersistDataAfterSubmit($value) 提交成功后清空本地缓存
 * @method self primaryField($value) 设置主键 id, 当设置后，检测表单是否完成时（asyncApi），只会携带此数据。
 * @method self rules($value) 组合校验规则，选填
 * @method self labelAlign($value) 表单label的对齐方式
 * @method self initApi($value) 用来初始化表单数据
 * @method self redirect($value) 
 * @method self submitOnInit($value) 表单初始先提交一次，联动的时候有用
 * @method self labelWidth($value) label自定义宽度，默认单位为px
 * @method self static($value) 展示态时的className
 * @method self horizontal($value) 如果是水平排版，这个属性可以细化水平排版的左右宽度占比。
 * @method self name($value) 
 * @method self submitOnChange($value) 修改的时候是否直接提交表单。
 * @method self preventEnterSubmit($value) 禁用回车提交
 * @method self hidden($value) 是否隐藏
 * @method self visibleOn($value) 是否显示表达式
 * @method self debug($value) 是否开启调试，开启后会在顶部实时显示表单项数据。
 * @method self columnCount($value) 表单项显示为几列
 * @method self reload($value) 
 * @method self disabled($value) 是否禁用
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self onEvent($value) 事件动作配置
 * @method self title($value) 表单标题
 * @method self api($value) Form 用来保存数据的 api。详情：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/index#%E8%A1%A8%E5%8D%95%E6%8F%90%E4%BA%A4
 * @method self staticClassName($value) 
 * @method self body($value) 表单项集合
 * @method self debugConfig($value) Debug面板配置
 * @method self initFinishedField($value) 设置了initAsyncApi后，默认会从返回数据的data.finished来判断是否完成，也可以设置成其他的xxx，就会从data.xxx中获取
 * @method self interval($value) 设置后将轮询调用 initApi
 * @method self stopAutoRefreshWhen($value) 配置停止轮询的条件
 * @method self persistDataKeys($value) 开启本地缓存后限制保存哪些 key
 * @method self clearAfterSubmit($value) 提交后清空表单
 * @method self initAsyncApi($value) Form 用来获取初始数据的 api,与initApi不同的是，会一直轮询请求该接口，直到返回 finished 属性为 true 才 结束。
 * @method self affixFooter($value) 是否固定底下的按钮在底部。
 * @method self panelClassName($value) 配置容器 panel className
 * @method self type($value) 指定为表单渲染器。
 * @method self initCheckInterval($value) 设置了initAsyncApi以后，默认拉取的时间间隔
 * @method self checkInterval($value) 轮询请求的时间间隔，默认为 3秒。设置 asyncApi 才有效
 * @method self finishedField($value) 如果决定结束的字段名不是 `finished` 请设置此属性，比如 `is_success`
 * @method self autoFocus($value) 是否自动将第一个表单元素聚焦。
 * @method self submitText($value) 默认的提交按钮名称，如果设置成空，则可以把默认按钮去掉。
 * @method self promptPageLeave($value) 页面离开提示，为了防止页面不小心跳转而导致表单没有保存。
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self silentPolling($value) 是否静默拉取
 * @method self feedback($value) Form 也可以配置 feedback。
 * @method self mode($value) 配置表单项默认的展示方式。 可选值: normal | inline | horizontal | 
 * @method self visible($value) 是否显示
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 */
class Form extends BaseRenderer
{
    public string $type = 'form';
}
