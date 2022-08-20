<?php

namespace Slowlyo\SlowAdmin\Traits;

trait QueryPath
{
    /**
     * 列表获取数据
     *
     * @return string
     */
    public function getListGetDataPath(): string
    {
        return $this->adminPrefix . '/' . $this->queryPath . '?_action=getData';
    }

    /**
     * 删除
     *
     * @return string
     */
    public function getDeletePath(): string
    {
        return 'delete:' . $this->adminPrefix . '/' . $this->queryPath . '/${id}';
    }

    /**
     * 批量删除
     *
     * @return string
     */
    public function getBulkDeletePath(): string
    {
        return 'delete:' . $this->adminPrefix . '/' . $this->queryPath . '/${ids}';
    }

    /**
     * 编辑页面
     *
     * @return string
     */
    public function getEditPath(): string
    {
        return $this->queryPath . '/${id}/edit';
    }

    /**
     * 编辑 获取数据
     *
     * @param $id
     *
     * @return string
     */
    public function getEditGetDataPath($id): string
    {
        return $this->adminPrefix . '/' . $this->queryPath . '/' . $id . '/edit?_action=getData';
    }

    /**
     * 详情页面
     *
     * @return string
     */
    public function getShowPath(): string
    {
        return $this->queryPath . '/${id}';
    }

    /**
     * 编辑保存
     *
     * @param $id
     *
     * @return string
     */
    public function getUpdatePath($id): string
    {
        return 'put:' . $this->adminPrefix . '/' . $this->queryPath . '/' . $id;
    }

    /**
     * 详情 获取数据
     *
     * @param $id
     *
     * @return string
     */
    public function getShowGetDataPath($id): string
    {
        return $this->adminPrefix . '/' . $this->queryPath . '/' . $id . '?_action=getData';
    }

    /**
     * 新增页面
     *
     * @return string
     */
    public function getCreatePath(): string
    {
        return $this->queryPath . '/create';
    }

    /**
     * 新增 保存
     *
     * @return string
     */
    public function getStorePath(): string
    {
        return 'post:' . $this->adminPrefix . '/' . $this->queryPath;
    }

    /**
     * 列表
     *
     * @return string
     */
    public function getListPath(): string
    {
        return '/' . $this->queryPath;
    }

}
