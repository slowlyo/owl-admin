<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

use Slowlyo\SlowAdmin\Renderers\BaseRenderer;

/**
 * <b>Group 表单项组</b><br/>
 * 表单项，默认都是一行显示一个，Group 组件用于在一行展示多个表单项，会自动根据表单项数量均分宽度。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/group
 *
 * @method self className($value) CSS 类名
 * @method self label($value) group 的标签
 * @method self body($value) 表单项集合
 * @method self mode($value) 展示默认，同 Form 中的模式
 * @method self gap($value) 表单项之间的间距，可选：xs、sm、normal
 * @method self direction($value) 可以配置水平展示还是垂直展示。对应的配置项分别是：vertical、horizontal
 */
class Group extends BaseRenderer
{
    public string $type = 'group';
}
