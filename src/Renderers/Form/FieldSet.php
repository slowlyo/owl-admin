<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

use Slowlyo\SlowAdmin\Renderers\BaseRenderer;

/**
 * <b>FieldSet 表单项集合</b><br/>
 * FieldSet 是用于分组展示表单项的一种容器型组件，可以折叠。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/fieldset
 *
 * @method self className($value) CSS 类名
 * @method self headingClassName($value) 标题 CSS 类名
 * @method self bodyClassName($value) 内容区域 CSS 类名
 * @method self title($value) 标题
 * @method self body($value) 表单项集合
 * @method self mode($value) 展示默认，同 Form 中的模式
 * @method self collapsable($value) 是否可折叠
 * @method self collapsed($value) 默认是否折叠
 * @method self collapseTitle($value) 收起的标题
 */
class FieldSet extends BaseRenderer
{
    public string $type = 'fieldSet';
}
