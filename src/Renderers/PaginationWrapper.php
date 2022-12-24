<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * 分页容器功能性渲染器。详情请见：https://aisuda.bce.baidu.com/amis/zh-CN/components/pagination-wrapper
 *
 * @method self hidden($value) 是否隐藏
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticSchema($value) 
 * @method self showPageInput($value) 是否显示快速跳转输入框
 * @method self maxButtons($value) 最多显示多少个分页按钮。
 * @method self outputName($value) 输出字段名
 * @method self disabled($value) 是否禁用
 * @method self visibleOn($value) 是否显示表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self static($value) 是否静态展示
 * @method self inputName($value) 输入字段名
 * @method self body($value) 内容区域
 * @method self visible($value) 是否显示
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self type($value) 指定为分页容器功能性渲染器
 * @method self perPage($value) 每页显示多条数据。
 * @method self onEvent($value) 事件动作配置
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self position($value) 分页显示位置，如果配置为 none 则需要自己在内容区域配置 pagination 组件，否则不显示。 可选值: top | bottom | none | 
 * @method self className($value) 容器 css 类名
 */
class PaginationWrapper extends BaseRenderer
{
    public string $type = 'pagination-wrapper';
}
