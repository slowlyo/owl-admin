<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

use Slowlyo\SlowAdmin\Renderers\BaseRenderer;

/**
 * <b>Form 表单</b><br/>
 * 表单是 amis 中核心组件之一，主要作用是提交或者展示表单数据。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/index
 *
 * @method self name($value) 设置一个名字后，方便其他组件与其通信
 * @method self mode($value) 表单展示方式，可以是：normal、horizontal 或者 inline
 * @method self horizontal($value) 当 mode 为 horizontal 时有用，用来控制 label
 * @method self labelAlign($value) 表单项标签对齐方式，默认右对齐，仅在 mode为horizontal 时生效
 * @method self labelWidth($value) 表单项标签自定义宽度
 * @method self title($value) Form 的标题
 * @method self submitText($value) 默认的提交按钮名称，如果设置成空，则可以把默认按钮去掉。
 * @method self className($value) 外层 Dom 的类名
 * @method self body($value) Form 表单项集合
 * @method self actions($value) Form 提交按钮，成员为 Action
 * @method self messages($value) 消息提示覆写，默认消息读取的是 API 返回的消息，但是在此可以覆写它。
 * @method self wrapWithPanel($value) 是否让 Form 用 panel 包起来，设置为 false 后，actions 将无效。
 * @method self panelClassName($value) 外层 panel 的类名
 * @method self api($value) Form 用来保存数据的 api。
 * @method self initApi($value) Form 用来获取初始数据的 api。
 * @method self rules($value) 表单组合校验规则
 * @method self interval($value) 刷新时间(最低 3000)
 * @method self silentPolling($value) 配置刷新时是否显示加载动画
 * @method self stopAutoRefreshWhen($value) 通过表达式 来配置停止刷新的条件
 * @method self initAsyncApi($value) Form 用来获取初始数据的 api, 与 initApi 不同的是，会一直轮询请求该接口，直到返回 finished 属性为 true 才 结束。
 * @method self initFetch($value) 设置了 initApi 或者 initAsyncApi 后，默认会开始就发请求，设置为 false 后就不会起始就请求接口
 * @method self initFetchOn($value) 用表达式来配置
 * @method self initFinishedField($value) 设置了 initAsyncApi 后，默认会从返回数据的 data.finished 来判断是否完成，也可以设置成其他的 xxx，就会从 data.xxx 中获取
 * @method self initCheckInterval($value) 设置了 initAsyncApi 以后，默认拉取的时间间隔
 * @method self asyncApi($value) 设置此属性后，表单提交发送保存接口后，还会继续轮询请求该接口，直到返回 finished 属性为 true 才 结束。
 * @method self checkInterval($value) 轮询请求的时间间隔，默认为 3 秒。设置 asyncApi 才有效
 * @method self finishedField($value) 如果决定结束的字段名不是 finished 请设置此属性，比如 is_success
 * @method self submitOnChange($value) 表单修改即提交
 * @method self submitOnInit($value) 初始就提交一次
 * @method self resetAfterSubmit($value) 提交后是否重置表单
 * @method self primaryField($value) 设置主键 id, 当设置后，检测表单是否完成时（asyncApi），只会携带此数据。
 * @method self target($value) 默认表单提交自己会通过发送 api 保存数据，但是也可以设定另外一个 form 的 name 值，或者另外一个 CRUD 模型的 name 值。 如果 target 目标是一个 Form ，则目标 Form 会重新触发 initApi，api 可以拿到当前 form 数据。如果目标是一个 CRUD 模型，则目标模型会重新触发搜索，参数为当前 Form 数据。当目标是 window 时，会把当前表单的数据附带到页面地址上。
 * @method self redirect($value) 设置此属性后，Form 保存成功后，自动跳转到指定页面。支持相对地址，和绝对地址（相对于组内的）。
 * @method self reload($value) 操作完后刷新目标对象。请填写目标组件设置的 name 值，如果填写为 window 则让当前页面整体刷新。
 * @method self autoFocus($value) 是否自动聚焦。
 * @method self canAccessSuperData($value) 指定是否可以自动获取上层的数据并映射到表单项上
 * @method self persistData($value) 指定一个唯一的 key，来配置当前表单是否开启本地缓存
 * @method self clearPersistDataAfterSubmit($value) 指定表单提交成功后是否清除本地缓存
 * @method self preventEnterSubmit($value) 禁用回车提交表单
 * @method self trimValues($value) trim 当前表单项的每一个值
 * @method self promptPageLeave($value) form 还没保存，即将离开页面前是否弹框确认。
 * @method self columnCount($value) 表单项显示为几列
 * @method self inheritData($value) 默认表单是采用数据链的形式创建个自己的数据域，表单提交的时候只会发送自己这个数据域的数据，如果希望共用上层数据域可以设置这个属性为 false，这样上层数据域的数据不需要在表单中用隐藏域或者显式映射才能发送了。
 */
class Form extends BaseRenderer
{
    public string $type = 'form';
}
