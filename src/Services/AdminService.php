<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Slowlyo\OwlAdmin\Renderers\Page;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Slowlyo\OwlAdmin\Traits\ErrorTrait;
use Illuminate\Database\Eloquent\Builder;
use Slowlyo\OwlAdmin\Renderers\TableColumn;

abstract class AdminService
{
    use ErrorTrait;

    protected $tableColumn;

    protected string $modelName;

    protected Request $request;

    public function __construct()
    {
        $this->request = request();
    }

    public static function make(): static
    {
        return new static;
    }

    public function setModelName($modelName)
    {
        $this->modelName = $modelName;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return new $this->modelName;
    }

    public function primaryKey()
    {
        return $this->getModel()->getKeyName();
    }

    public function getTableColumns()
    {
        if (!$this->tableColumn) {
            try {
                // laravel11: sqlite 暂时无法获取字段, 等待 laravel 适配
                $this->tableColumn = Schema::connection($this->getModel()->getConnectionName())
                    ->getColumnListing($this->getModel()->getTable());
            } catch (\Throwable $e) {
                $this->tableColumn = [];
            }
        }

        return $this->tableColumn;
    }

    public function hasColumn($column)
    {
        $columns = $this->getTableColumns();

        if (blank($columns)) return true;

        return in_array($column, $columns);
    }

    public function query()
    {
        return $this->modelName::query();
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
        $query = $this->query();

        $this->addRelations($query, 'detail');

        return $query->find($id);
    }

    /**
     * 编辑 获取数据
     *
     * @param $id
     *
     * @return Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
     */
    public function getEditData($id)
    {
        $model = $this->getModel();

        $hidden = collect([$model->getCreatedAtColumn(), $model->getUpdatedAtColumn()])
            ->filter(fn($item) => $item !== null)
            ->toArray();

        $query = $this->query();

        $this->addRelations($query, 'edit');

        return $query->find($id)->makeHidden($hidden);
    }

    /**
     * 列表 获取查询
     *
     * @return Builder
     */
    public function listQuery()
    {
        $query = $this->query();

        // 处理排序
        $this->sortable($query);

        // 自动加载 TableColumn 内的关联关系
        $this->loadRelations($query);

        // 处理查询
        $this->searchable($query);

        // 追加关联关系
        $this->addRelations($query);

        return $query;
    }

    /**
     * 添加关联关系
     *
     * 预留钩子, 方便处理只需要添加 [关联] 的情况
     *
     * @param        $query
     * @param string $scene 场景: list, detail, edit
     *
     * @return void
     */
    public function addRelations($query, string $scene = 'list')
    {

    }

    /**
     * 根据 tableColumn 定义的列, 自动加载关联关系
     *
     * @param $query
     *
     * @return void
     */
    public function loadRelations($query)
    {
        $controller = Route::getCurrentRoute()->getController();

        // 当前列表结构
        $schema = method_exists($controller, 'list') ? $controller->list() : '';

        if (!$schema instanceof Page) return;

        // 字段
        $columns = $schema->toArray()['body']->amisSchema['columns'] ?? [];

        $relations = [];
        foreach ($columns as $column) {
            // 排除非表格字段
            if (!$column instanceof TableColumn) continue;
            // 拆分字段名
            $field = $column->amisSchema['name'];
            // 是否是多层级
            if (str_contains($field, '.')) {
                // 去除字段名
                $list = array_slice(explode('.', $field), 0, -1);
                try {
                    $_class = $this->modelName;
                    foreach ($list as $item) {
                        $_class = app($_class)->{$item}()->getModel()::class;
                    }
                } catch (\Throwable $e) {
                    continue;
                }
                $relations[] = implode('.', $list);
            }
        }

        // 加载关联关系
        $query->with(array_unique($relations));
    }

    /**
     * 排序
     *
     * @param $query
     *
     * @return void
     */
    public function sortable($query)
    {
        if (request()->orderBy && request()->orderDir) {
            $query->orderBy(request()->orderBy, request()->orderDir ?? 'asc');
        } else {
            $query->orderByDesc($this->sortColumn());
        }
    }

    /**
     * 搜索
     *
     * @param $query
     *
     * @return void
     */
    public function searchable($query)
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
     * 列表 排序字段
     *
     * @return string
     */
    public function sortColumn()
    {
        $updatedAtColumn = $this->getModel()->getUpdatedAtColumn();

        if ($this->hasColumn($updatedAtColumn)) {
            return $updatedAtColumn;
        }

        if ($this->hasColumn($this->getModel()->getKeyName())) {
            return $this->getModel()->getKeyName();
        }

        return Arr::first($this->getTableColumns());
    }

    /**
     * 格式化列表数据
     *
     * @param array $rows 一次分页的数据
     *
     * @return array
     */
    public function formatRows(array $rows)
    {
        return $rows;
    }

    /**
     * 列表 获取数据
     *
     * @return array
     */
    public function list()
    {
        $query = $this->listQuery();

        $list  = $query->paginate(request()->input('perPage', 20));
        $items = $this->formatRows($list->items());
        $total = $list->total();

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
    public function update($primaryKey, $data)
    {
        $this->saving($data, $primaryKey);

        $model = $this->query()->whereKey($primaryKey)->first();

        foreach ($data as $k => $v) {
            if (!$this->hasColumn($k)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        $result = $model->save();

        if ($result) {
            $this->saved($model, true);
        }

        return $result;
    }

    /**
     * 新增
     *
     * @param $data
     *
     * @return bool
     */
    public function store($data)
    {
        $this->saving($data);

        $model = $this->getModel();

        foreach ($data as $k => $v) {
            if (!$this->hasColumn($k)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        $result = $model->save();

        if ($result) {
            $this->saved($model);
        }

        return $result;
    }

    /**
     * 删除
     *
     * @param string $ids
     *
     * @return mixed
     */
    public function delete(string $ids)
    {
        $result = $this->query()->whereIn($this->primaryKey(), explode(',', $ids))->delete();

        if ($result) {
            $this->deleted($ids);
        }

        return $result;
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

    /**
     * saving 钩子 (执行于新增/修改前)
     *
     * 可以通过判断 $primaryKey 是否存在来判断是新增还是修改
     *
     * @param $data
     * @param $primaryKey
     *
     * @return void
     */
    public function saving(&$data, $primaryKey = '')
    {

    }

    /**
     * saved 钩子 (执行于新增/修改后)
     *
     * 可以通过 $isEdit 来判断是新增还是修改
     *
     * @param $model
     * @param $isEdit
     *
     * @return void
     */
    public function saved($model, $isEdit = false)
    {

    }

    /**
     * deleted 钩子 (执行于删除后)
     *
     * @param $ids
     *
     * @return void
     */
    public function deleted($ids)
    {

    }
}
