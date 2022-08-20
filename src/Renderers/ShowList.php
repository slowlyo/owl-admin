<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>List 列表</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/list
 *
 * @method self title($value) 标题
 * @method self source($value) 数据源, 获取当前数据域变量，支持数据映射
 * @method self placeholder($value) 当没数据的时候的文字提示
 * @method self className($value) 外层 CSS 类名
 * @method self headerClassName($value) 顶部外层 CSS 类名
 * @method self footerClassName($value) 底部外层 CSS 类名
 * @method self listItem($value) 配置单条信息
 */
class ShowList extends BaseRenderer
{
    public string $type = 'list';
}
