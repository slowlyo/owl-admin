<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

use Slowlyo\SlowAdmin\Renderers\BaseRenderer;

/**
 * <b>组合条件</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/condition-builder
 *
 * @method self className($value) 外层 dom 类名
 * @method self fieldClassName($value) 输入字段的类名
 * @method self source($value) 通过远程拉取配置项
 * @method self embed($value) 内嵌展示
 * @method self title($value) 弹窗配置的顶部标题
 * @method self fields($value) 字段配置
 * @method self showANDOR($value) 用于 simple 模式下显示切换按钮
 * @method self showNot($value) 是否显示「非」按钮
 * @method self searchable($value) 字段是否可搜索
 *
 */
class ConditionBuilder extends BaseRenderer
{
    public string $type = 'condition-builder';
}
