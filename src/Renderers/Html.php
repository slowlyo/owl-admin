<?php

namespace Slowlyo\SlowAdmin\Renderers;

use Illuminate\Support\Str;

/**
 * <b>Html</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/html
 */
class Html extends BaseRenderer
{
    public string $type = 'html';

    public function html($html)
    {

        $js = Str::between($html, '<script', '</script>');
        $js = '<script ' . $js . '</script>';
        dd($js);

        $this->html = $html;
    }
}
