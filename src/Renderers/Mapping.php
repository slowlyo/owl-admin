<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Mapping 映射</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/mapping
 *
 * @method self className($value) 外层 CSS 类名
 * @method self placeholder($value) 占位文本
 * @method self map($value) 映射配置
 * @method self source($value) API 或 数据映射
 */
class Mapping extends BaseRenderer
{
    public string $type = 'mapping';
}
