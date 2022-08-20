<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Remark 标记</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/remark
 *
 * @method self className($value) 外层 CSS 类名
 * @method self content($value) 提示文本
 * @method self placement($value) 弹出位置
 * @method self trigger($value) 触发条件
 * @method self icon($value) 图标
 * @method self shape($value) 图标形状
 */
class Remark extends BaseRenderer
{
    public string $type = 'remark';
}
