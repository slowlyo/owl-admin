<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

use Slowlyo\SlowAdmin\Renderers\BaseRenderer;

/**
 * <b>Formula 公式</b><br/>
 * 可以设置公式，将公式结果设置到指定表单项上。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/formula
 *
 * @method self name($value) 需要应用的表单项name值，公式结果将作用到此处指定的变量中去。
 * @method self formula($value) 应用的公式
 * @method self condition($value) 公式作用条件
 * @method self initSet($value) 初始化时是否设置
 * @method self autoSet($value) 观察公式结果，如果计算结果有变化，则自动应用到变量上
 * @method self id($value) 定义个名字，当某个按钮的目标指定为此值后，会触发一次公式应用。这个机制可以在 autoSet 为 false 时用来手动触发
 */
class Formula extends BaseRenderer
{
    public string $type = 'formula';
}
