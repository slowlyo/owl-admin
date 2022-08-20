<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Status 状态</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/status
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self placeholder($value) 占位文本
 * @method self map($value) 映射图标
 * @method self labelMap($value) 映射文本
 */
class Status extends BaseRenderer
{
    public string $type = 'status';
}
