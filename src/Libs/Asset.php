<?php

namespace Slowlyo\OwlAdmin\Libs;

class Asset
{
    protected array $js = [];

    protected array $css = [];

    protected array $scripts = [];

    protected array $styles = [];

    private function assetsHandler($type, $assets)
    {
        if (is_null($assets)) {
            return $this->{$type};
        }

        if (is_array($assets)) {
            $this->{$type} = array_merge($this->{$type}, $assets);
        } else {
            $this->{$type}[] = $assets;
        }

        return $this;
    }

    public function js($js = null)
    {
        return $this->assetsHandler('js', $js);
    }

    public function css($css = null)
    {
        return $this->assetsHandler('css', $css);
    }

    public function scripts($scripts = null)
    {
        return $this->assetsHandler('scripts', $scripts);
    }

    public function styles($styles = null)
    {
        return $this->assetsHandler('styles', $styles);
    }
}
