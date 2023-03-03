<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Link 链接展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/link
 *
 * @method self body($value) 链接内容，如果不配置将显示链接地址。
 * @method self htmlTarget($value) a标签原生target属性
 * @method self onEvent($value) 事件动作配置
 * @method self disabledOn($value) 是否禁用表达式
 * @method self visibleOn($value) 是否显示表达式
 * @method self static($value) 是否静态展示
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self type($value) 指定为 link 链接展示控件
 * @method self className($value) 容器 css 类名
 * @method self rightIcon($value) 右侧图标
 * @method self badge($value) 角标
 * @method self hidden($value) 是否隐藏
 * @method self visible($value) 是否显示
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticSchema($value) 
 * @method self disabled($value) 是否禁用
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self blank($value) 是否新窗口打开。
 * @method self href($value) 链接地址
 * @method self icon($value) 图标
 */
class Link extends BaseRenderer
{
    public string $type = 'link';
}
