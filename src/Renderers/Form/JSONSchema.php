<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

use Slowlyo\SlowAdmin\Renderers\BaseRenderer;

/**
 * <b>JSONSchema</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/json-schema
 *
 * @method self schema($value) 指定 json-schema
 */
class JSONSchema extends BaseRenderer
{
    public string $type = 'json-schema';
}
