<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputCity 城市选择器</b><br/>
 * 城市选择器，方便输入城市，可以理解为自动配置了国内城市选项的 Select，支持到县级别。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-city
 *
 * @method self allowCity($value = true) 允许选择城市
 * @method self allowDistrict($value = true) 允许选择区域
 * @method self searchable($value = true) 是否出搜索框
 * @method self extractValue($value) 默认 true 是否抽取值，如果设置成 false 值格式会变成对象，包含 code、province、city 和 district 文字信息。
 */
class InputCity extends FormItem
{
    public string $type = 'input-city';
}
