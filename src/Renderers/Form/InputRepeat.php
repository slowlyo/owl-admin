<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputRepeat 重复频率选择器</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-repeat
 *
 * @method self options($value) 可用配置 secondly, minutely, hourly, daily, weekdays, weekly, monthly, yearly
 * @method self placeholder($value) 当不指定值时的说明。
 */
class InputRepeat extends FormItem
{
    public string $type = 'input-repeat';
}
