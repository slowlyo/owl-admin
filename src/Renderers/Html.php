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
        $this->html = $html;

        return $this;
    }

    public function setView($view): array
    {
        $html = view($view)->render();

        $assets = $this->getAssets($html);

        $this->html = $html;

        return [$this, $assets];
    }

    private function getAssets($html): array
    {
        return [
            'link'   => $this->getLink(),
            'script' => $this->getScript($html),
        ];
    }

    private function getScript($html): string
    {
        return collect(explode('<script', $html))->transform(function ($item) {
            if (Str::contains($item, 'script>')) {
                $_script = Str::between('<script' . $item, '<script', '</script>');

                return Str::after($_script, '>');
            }

            return null;
        })->filter()->implode('');
    }
}
