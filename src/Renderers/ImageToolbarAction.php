<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self iconClassName($value) 
 * @method self disabled($value) 
 * @method self key($value)  可选值: ROTATE_RIGHT | ROTATE_LEFT | ZOOM_IN | ZOOM_OUT | SCALE_ORIGIN | 
 * @method self label($value) 
 * @method self icon($value) 
 */
class ImageToolbarAction extends BaseRenderer
{
    public string $key = 'ROTATE_RIGHT';
}
