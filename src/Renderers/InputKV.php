<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * <b>InputKV 键值对</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-kv
 *
 * @method self valueType($value) 值类型
 * @method self keyPlaceholder($value) key 的提示信息的
 * @method self valuePlaceholder($value) value 的提示信息的
 * @method self draggable($value) 是否可拖拽排序
 * @method self defaultValue($value) 默认值
 */
class InputKV extends BaseRenderer
{
    public string $type = 'input-kv';
}
