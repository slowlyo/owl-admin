<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>PaginationWrapper 分页容器</b><br/>
 * 可以把相关信息以面板的形式展示到一块。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/panel
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self headerClassName($value) header 区域的类名
 * @method self footerClassName($value) footer 区域的类名
 * @method self actionsClassName($value) actions 区域的类名
 * @method self bodyClassName($value) body 区域的类名
 * @method self title($value) 标题
 * @method self header($value) 头部容器
 * @method self body($value) 内容容器
 * @method self footer($value) 底部容器
 * @method self affixFooter($value) 是否固定底部容器
 * @method self actions($value) 按钮区域
 */
class Panel extends BaseRenderer
{
    public string $type = 'panel';
}
