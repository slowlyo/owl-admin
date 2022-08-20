<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Wizard 向导</b><br/>
 * 表单向导，能够配置多个步骤引导用户一步一步完成表单提交。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/wizard
 *
 * @method self mode($value) 展示模式，选择：horizontal 或者 vertical
 * @method self api($value) 最后一步保存的接口。
 * @method self initApi($value) 初始化数据接口
 * @method self initFetch($value) 初始是否拉取数据。
 * @method self initFetchOn($value) 初始是否拉取数据，通过表达式来配置
 * @method self actionPrevLabel($value) 上一步按钮文本
 * @method self actionNextLabel($value) 下一步按钮文本
 * @method self actionNextSaveLabel($value) 保存并下一步按钮文本
 * @method self actionFinishLabel($value) 完成按钮文本
 * @method self className($value) 外层 CSS 类名
 * @method self actionClassName($value) 按钮 CSS 类名
 * @method self reload($value) 操作完后刷新目标对象。请填写目标组件设置的 name 值，如果填写为 window 则让当前页面整体刷新。
 * @method self redirect($value) 操作完后跳转。
 * @method self target($value) 可以把数据提交给别的组件而不是自己保存。请填写目标组件设置的 name 值，如果填写为 window 则把数据同步到地址栏上，同时依赖这些数据的组件会自动重新刷新。
 * @method self steps($value) 数组，配置步骤信息
 * @method self startStep($value) 起始默认值，从第几步开始。可支持模版，但是只有在组件创建时渲染模版并设置当前步数，在之后组件被刷新时，当前 step 不会根据 startStep 改变
 */
class Wizard extends BaseRenderer
{
    public string $type = 'wizard';
}
