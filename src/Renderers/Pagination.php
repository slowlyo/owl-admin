<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self hasNext($value) 
 * @method self maxButtons($value) 最多显示多少个分页按钮。
 * @method self mode($value) 模式，默认normal，如果只想简单显示可以配置成 `simple`。
 * @method self showPageInput($value) 是否显示快速跳转输入框
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self onEvent($value) 事件动作配置
 * @method self static($value) 是否静态展示
 * @method self staticOn($value) 是否静态展示表达式
 * @method self activePage($value) 当前页数
 * @method self perPageAvailable($value) 指定每页可以显示多少条
 * @method self className($value) 容器 css 类名
 * @method self disabled($value) 是否禁用
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self type($value) 
 * @method self perPage($value) 每页显示条数
 * @method self showPerPage($value) 是否展示分页切换，也同时受layout控制
 * @method self popOverContainerSelector($value) 弹层挂载节点
 * @method self disabledOn($value) 是否禁用表达式
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self staticSchema($value) 
 * @method self layout($value) 通过控制layout属性的顺序，调整分页结构 total,perPage,pager,go
 * @method self lastPage($value) 最后一页，总页数（如果传入了total，会重新计算lastPage）
 * @method self hidden($value) 是否隐藏
 * @method self visible($value) 是否显示
 * @method self total($value) 总条数
 */
class Pagination extends BaseRenderer
{
    public string $type = 'pagination';
}
