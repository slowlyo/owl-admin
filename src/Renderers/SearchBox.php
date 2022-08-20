<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Search Box 搜索框</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/search-box
 *
 * @method self className($value) 外层 CSS 类名
 * @method self mini($value) 是否为 mini 模式
 * @method self searchImediately($value) 是否立即搜索
 */
class SearchBox extends BaseRenderer
{
    public string $type = 'search-box';
}
