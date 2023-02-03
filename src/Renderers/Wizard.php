<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * 表单向导 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/wizard
 *
 * @method self readOnly($value) 是否为只读模式。
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self className($value) 容器 css 类名
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self loadingConfig($value) 
 * @method self disabled($value) 是否禁用
 * @method self actionClassName($value) 配置按钮 className
 * @method self name($value) 
 * @method self startStep($value) 
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self actionNextLabel($value) 下一步按钮的文字描述
 * @method self actionPrevLabel($value) 上一步按钮的文字描述
 * @method self api($value) Wizard 用来保存数据的 api。 [详情](https://baidu.github.io/amis/docs/api#wizard)
 * @method self visible($value) 是否显示
 * @method self static($value) 是否静态展示
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticSchema($value) 
 * @method self actionNextSaveLabel($value) 下一步并且保存按钮的文字描述
 * @method self mode($value) 展示模式 可选值: vertical | horizontal | 
 * @method self redirect($value) 保存完后，可以指定跳转地址，支持相对路径和组内绝对路径，同时可以通过 $xxx 使用变量
 * @method self reload($value) 
 * @method self hidden($value) 是否隐藏
 * @method self onEvent($value) 事件动作配置
 * @method self affixFooter($value) 是否将底部按钮固定在底部。
 * @method self initApi($value) Wizard 用来获取初始数据的 api。
 * @method self target($value) 默认表单提交自己会通过发送 api 保存数据，但是也可以设定另外一个 form 的 name 值，或者另外一个 `CRUD` 模型的 name 值。 如果 target 目标是一个 `Form` ，则目标 `Form` 会重新触发 `initApi` 和 `schemaApi`，api 可以拿到当前 form 数据。如果目标是一个 `CRUD` 模型，则目标模型会重新触发搜索，参数为当前 Form 数据。
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self bulkSubmit($value) 是否合并后再提交
 * @method self actionFinishLabel($value) 完成按钮的文字描述
 * @method self steps($value) 
 * @method self type($value) 指定为表单向导
 */
class Wizard extends BaseRenderer
{
    public string $type = 'wizard';
}
