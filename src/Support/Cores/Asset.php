<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

class Asset
{
    protected array $js = [];

    protected array $css = [];

    protected array $scripts = [];

    protected array $styles = [];

    protected $appendNav;

    protected $prependNav;

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

    public function appendNav($appendNav = null)
    {
        if (is_null($appendNav)) {
            return $this->appendNav;
        }

		$this->appendNav = $this->appendNav ? array_merge($this->appendNav, $appendNav) : $appendNav;

        return $this;
    }

    public function prependNav($prependNav = null)
    {
        if (is_null($prependNav)) {
            return $this->prependNav;
        }

		$this->prependNav = $this->prependNav ? array_merge($this->prependNav, $prependNav) : $prependNav;

        return $this;
    }
}
