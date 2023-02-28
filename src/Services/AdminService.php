<?php

namespace Slowlyo\SlowAdmin\Services;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Slowlyo\SlowAdmin\Traits\ErrorTrait;
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

    public function getTableColumns()
    {
        return Schema::connection($this->getModel()->getConnectionName())->getColumnListing($this->getModel()->getTable());
    }

    public function query(): Builder
    {
        $query = $this->modelName::query();

        if (request()->orderBy && request()->orderDir) {
            $query->orderBy(request()->orderBy, request()->orderDir ?? 'asc');
        }

        return $query;
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
     * 列表 获取数据
     *
     * @return array
     */
    public function list()
    {
        $items = $this->query()->paginate(request()->input('perPage', 20))->items();
        $total = $this->query()->count();

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
        return $this->query()->whereIn('id', explode(',', $ids))->delete();
    }
}
