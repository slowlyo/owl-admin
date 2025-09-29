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

        $this->appendNav = $appendNav;

        return $this;
    }

    public function prependNav($prependNav = null)
    {
        if (is_null($prependNav)) {
            return $this->prependNav;
        }

        $this->prependNav = $prependNav;

        return $this;
    }

    /**
     * 重置资源状态 (用于 Octane 等长驻进程下的请求隔离)
     *
     * @return void
     */
    public function flush(): void
    {
        $this->js = [];
        $this->css = [];
        $this->scripts = [];
        $this->styles = [];
        $this->appendNav = null;
        $this->prependNav = null;
    }
}
