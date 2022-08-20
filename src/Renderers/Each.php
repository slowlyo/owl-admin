<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Each 循环渲染器</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/each
 *
 * @method self value($value) 用于循环的值
 * @method self name($value) 获取数据域中变量
 * @method self source($value) 获取数据域中变量， 支持 数据映射
 * @method self items($value) 使用value中的数据，循环输出渲染器。
 * @method self placeholder($value) 当 value 值不存在或为空数组时的占位文本
 */
class Each extends BaseRenderer
{
    public string $type = 'each';
}
