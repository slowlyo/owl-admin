<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Json</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/json
 *
 * @method self className($value) 外层 CSS 类名
 * @method self value($value) json 值，如果是 string 会自动 parse
 * @method self source($value) 通过数据映射获取数据链中的值
 * @method self placeholder($value) 占位文本
 * @method self levelExpand($value) 默认展开的层级
 * @method self jsonTheme($value) 主题，可选twilight和eighties
 * @method self mutable($value = true) 是否可修改
 * @method self displayDataTypes($value = true) 是否显示数据类型
 * @method self ellipsisThreshold($value) 设置字符串的最大展示长度，点击字符串可以切换全量/部分展示方式，默认展示全量字符串
 */
class Json extends BaseRenderer
{
    public string $type = 'json';
}
