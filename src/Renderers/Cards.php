<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Cards 卡片组</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/cards
 *
 * @method self title($value) 标题
 * @method self source($value) 数据源, 获取当前数据域中的变量
 * @method self placeholder($value) 当没数据的时候的文字提示
 * @method self className($value) 外层 CSS 类名
 * @method self headerClassName($value) 顶部外层 CSS 类名
 * @method self footerClassName($value) 底部外层 CSS 类名
 * @method self itemClassName($value) 卡片 CSS 类名
 * @method self card($value) 配置卡片信息
 */
class Cards extends BaseRenderer
{
    public string $type = 'cards';
}
