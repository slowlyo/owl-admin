<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>PaginationWrapper 分页容器</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/pagination-wrapper
 *
 * @method self showPageInput($value) 是否显示快速跳转输入框
 * @method self maxButtons($value) 最多显示多少个分页按钮
 * @method self inputName($value) 输入字段名
 * @method self outputName($value) 输出字段名
 * @method self perPage($value) 每页显示多条数据
 * @method self position($value) 分页显示位置，如果配置为 none 则需要自己在内容区域配置 pagination 组件，否则不显示
 * @method self body($value) 内容区域
 */
class PaginationWrapper extends BaseRenderer
{
    public string $type = 'pagination-wrapper';
}
