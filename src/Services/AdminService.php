<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Slowlyo\OwlAdmin\Traits\ErrorTrait;
use Illuminate\Database\Eloquent\Builder;

abstract class AdminService
{
    use ErrorTrait;

    public static function make(): static
    {
        return new static;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return new $this->modelName;
    }

    public function primaryKey()
    {
        return $this->getModel()->getKeyName();
    }

    public function getTableColumns()
    {
        return Schema::connection($this->getModel()->getConnectionName())
            ->getColumnListing($this->getModel()->getTable());
    }

    public function query(): Builder
    {
        $query = $this->modelName::query();

        // 支持 sortable 属性
        if (request()->orderBy && request()->orderDir) {
            $query->orderBy(request()->orderBy, request()->orderDir ?? 'asc');
        }

        // 支持 searchable 属性
        $this->searchable($query);

        return $query;
    }

    protected function searchable($query)
    {
        collect(array_keys(request()->query()))
            ->intersect($this->getTableColumns())
            ->map(function ($field) use ($query) {
                $query->when(request($field), function ($query) use ($field) {
                    $query->where($field, 'like', '%' . request($field) . '%');
                });
            });
    }

    /**
     * 详情 获取数据
     *
     * @param $id
     *
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function getDetail($id)
    {
        return $this->query()->find($id);
    }

    /**
     * 编辑 获取数据
     *
     * @param $id
     *
     * @return Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
     */
    public function getEditData($id): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
    {
        $model = $this->getModel();

        return $this->query()->find($id)->makeHidden([$model->getCreatedAtColumn(), $model->getUpdatedAtColumn()]);
    }

    /**
     * 列表 获取查询
     *
     * @return Builder
     */
    public function listQuery()
    {
        return $this->query()->orderByDesc($this->sortColumn());
    }

    /**
     * 列表 排序字段
     *
     * @return string
     */
    public function sortColumn()
    {
        return $this->getModel()->getUpdatedAtColumn() ?? $this->getModel()->getKeyName();
    }

    /**
     * 列表 获取数据
     *
     * @return array
     */
    public function list()
    {
        $query = $this->listQuery();

        $items = (clone $query)->paginate(request()->input('perPage', 20))->items();
        $total = (clone $query)->count();

        return compact('items', 'total');
    }

    /**
     * 修改
     *
     * @param $primaryKey
     * @param $data
     *
     * @return bool
     */
    public function update($primaryKey, $data): bool
    {
        $columns = $this->getTableColumns();
        $model   = $this->query()->whereKey($primaryKey)->first();

        foreach ($data as $k => $v) {
            if (!in_array($k, $columns)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        return $model->save();
    }

    /**
     * 新增
     *
     * @param $data
     *
     * @return bool
     */
    public function store($data): bool
    {
        $columns = $this->getTableColumns();
        $model   = $this->getModel();

        foreach ($data as $k => $v) {
            if (!in_array($k, $columns)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        return $model->save();
    }

    /**
     * 删除
     *
     * @param string $ids
     *
     * @return mixed
     */
    public function delete(string $ids): mixed
    {
        return $this->query()->whereIn($this->primaryKey(), explode(',', $ids))->delete();
    }

    /**
     * 快速编辑
     *
     * @param $data
     *
     * @return true
     */
    public function quickEdit($data)
    {
        $rowsDiff = data_get($data, 'rowsDiff', []);

        foreach ($rowsDiff as $item) {
            $this->update(Arr::pull($item, $this->primaryKey()), $item);
        }

        return true;
    }

    /**
     * 快速编辑单条
     *
     * @param $data
     *
     * @return bool
     */
    public function quickEditItem($data)
    {
        return $this->update(Arr::pull($data, $this->primaryKey()), $data);
    }
}
