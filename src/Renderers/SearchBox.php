<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * 搜索框渲染器
 *
 * @method self hidden($value) 是否隐藏
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticSchema($value) 
 * @method self enhance($value) 是否为加强样式
 * @method self className($value) 外层 css 类名
 * @method self disabled($value) 是否禁用
 * @method self visible($value) 是否显示
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self static($value) 是否静态展示
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self placeholder($value) 占位符
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self type($value) 指定为搜索框。文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/search-box
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self onEvent($value) 事件动作配置
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self name($value) 关键字名字。
 * @method self mini($value) 是否为 Mini 样式。
 * @method self clearable($value) 是否可清除
 * @method self searchImediately($value) 是否立马搜索。
 */
class SearchBox extends BaseRenderer
{
    public string $type = 'search-box';
}
