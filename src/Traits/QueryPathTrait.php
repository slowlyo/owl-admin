<?php

namespace Slowlyo\OwlAdmin\Traits;

use Illuminate\Support\Str;

trait QueryPathTrait
{
    /**
     * 列表获取数据
     *
     * @return string
     */
    public function getListGetDataPath()
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
    public function getDeletePath()
    {
        $primaryKey = isset($this->service) ? $this->service->primaryKey() : 'id';

        return 'delete:' . admin_url($this->queryPath . '/${' . $primaryKey . '}');
    }

    /**
     * 批量删除
     *
     * @return string
     */
    public function getBulkDeletePath()
    {
        return 'delete:' . admin_url($this->queryPath . '/${ids}');
    }

    /**
     * 编辑页面
     *
     * @return string
     */
    public function getEditPath()
    {
        return '/' . trim($this->queryPath, '/') . '/${' . $this->service->primaryKey() . '}/edit';
    }

    /**
     * 编辑 获取数据
     *
     * @return string
     */
    public function getEditGetDataPath()
    {
        $path = str_replace('/edit', '', $this->queryPath);

        $last = collect(explode('/', $path))->last();

        if (!is_numeric($last)) {
            $primaryKey = isset($this->service) ? $this->service->primaryKey() : 'id';

            $path .= '/${' . $primaryKey . '}/edit';
        }

        return admin_url($path . '?_action=getData');
    }

    /**
     * 详情页面
     *
     * @return string
     */
    public function getShowPath()
    {
        return '/' . trim($this->queryPath, '/') . '/${' . $this->service->primaryKey() . '}';
    }

    /**
     * 编辑保存
     *
     * @return string
     */
    public function getUpdatePath()
    {
        $path = str_replace('/edit', '', $this->queryPath);

        $last = collect(explode('/', $path))->last();

        if (!is_numeric($last)) {
            $primaryKey = isset($this->service) ? $this->service->primaryKey() : 'id';

            $path .= '/${' . $primaryKey . '}';
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
    public function getShowGetDataPath()
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
    public function getCreatePath()
    {
        return '/' . trim($this->queryPath, '/') . '/create';
    }

    /**
     * 新增 保存
     *
     * @return string
     */
    public function getStorePath()
    {
        return 'post:' . admin_url(str_replace('/create', '', $this->queryPath));
    }

    /**
     * 列表
     *
     * @return string
     */
    public function getListPath()
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
