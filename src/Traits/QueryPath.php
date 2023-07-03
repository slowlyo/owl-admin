<?php

namespace Slowlyo\OwlAdmin\Traits;

use Illuminate\Support\Str;

trait QueryPath
{
    /**
     * 列表获取数据
     *
     * @return string
     */
    public function getListGetDataPath(): string
    {
        return admin_url($this->queryPath . '?_action=getData');
    }

    /**
     * 导出
     *
     * @return string
     */
    public function getExportPath()
    {
        return admin_url($this->queryPath . '?_action=export', true);
    }

    /**
     * 删除
     *
     * @return string
     */
    public function getDeletePath(): string
    {
        return 'delete:' . admin_url($this->queryPath . '/${' . $this->service->primaryKey() . '}');
    }

    /**
     * 批量删除
     *
     * @return string
     */
    public function getBulkDeletePath(): string
    {
        return 'delete:' . admin_url($this->queryPath . '/${ids}');
    }

    /**
     * 编辑页面
     *
     * @return string
     */
    public function getEditPath(): string
    {
        return '/' . trim($this->queryPath, '/') . '/${' . $this->service->primaryKey() . '}/edit';
    }

    /**
     * 编辑 获取数据
     *
     * @return string
     */
    public function getEditGetDataPath(): string
    {
        $path = str_replace('/edit', '', $this->queryPath);

        $last = collect(explode('/', $path))->last();

        if (!is_numeric($last)) {
            $path .= '/${' . $this->service->primaryKey() . '}/edit';
        }

        return admin_url($path . '?_action=getData');
    }

    /**
     * 详情页面
     *
     * @return string
     */
    public function getShowPath(): string
    {
        return '/' . trim($this->queryPath, '/') . '/${' . $this->service->primaryKey() . '}';
    }

    /**
     * 编辑保存
     *
     * @return string
     */
    public function getUpdatePath(): string
    {
        $path = str_replace('/edit', '', $this->queryPath);

        $last = collect(explode('/', $path))->last();

        if (!is_numeric($last)) {
            $path .= '/${' . $this->service->primaryKey() . '}';
        }

        return 'put:' . admin_url($path);
    }

    /**
     * 快速编辑
     *
     * @return string
     */
    public function getQuickEditPath()
    {
        return $this->getStorePath() . '?_action=quickEdit';
    }

    public function getQuickEditItemPath()
    {
        return $this->getStorePath() . '?_action=quickEditItem';
    }

    /**
     * 详情 获取数据
     *
     * @return string
     */
    public function getShowGetDataPath(): string
    {
        $path = $this->queryPath;

        $last = collect(explode('/', $this->queryPath))->last();

        if (!is_numeric($last)) {
            $path .= '/${' . $this->service->primaryKey() . '}';
        }

        return admin_url($path . '?_action=getData');
    }

    /**
     * 新增页面
     *
     * @return string
     */
    public function getCreatePath(): string
    {
        return '/' . trim($this->queryPath, '/') . '/create';
    }

    /**
     * 新增 保存
     *
     * @return string
     */
    public function getStorePath(): string
    {
        return 'post:' . admin_url(str_replace('/create', '', $this->queryPath));
    }

    /**
     * 列表
     *
     * @return string
     */
    public function getListPath(): string
    {
        $path = $this->queryPath;

        if (Str::contains($this->queryPath, '/create')) {
            $path = str_replace('/create', '', $path);
        }

        if (Str::contains($this->queryPath, '/edit')) {
            $_path = explode('/', $path);
            array_pop($_path);
            array_pop($_path);
            $path = implode('/', $_path);
        }

        return '/' . trim($path, '/');
    }
}
