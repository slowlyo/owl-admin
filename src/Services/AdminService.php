<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Slowlyo\OwlAdmin\Renderers\Page;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Slowlyo\OwlAdmin\Traits\ErrorTrait;
use Illuminate\Database\Eloquent\Builder;
use Slowlyo\OwlAdmin\Renderers\TableColumn;
use Slowlyo\OwlAdmin\Support\Cores\Database;

abstract class AdminService
{
    use ErrorTrait;

    protected $tableColumn;

    protected string $modelName;

    protected Request $request;

    protected ?Model $currentModel = null;

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

    /**
     * 获取当前操作的数据实例（新增/修改后）
     *
     * @return Model|null
     */
    public function getCurrentModel(): ?Model
    {
        return $this->currentModel;
    }

    /**
     * 设置当前操作的数据实例
     *
     * @param Model|null $model
     * @return $this
     */
    public function setCurrentModel(?Model $model): static
    {
        $this->currentModel = $model;
        return $this;
    }

    public function primaryKey()
    {
        return $this->getModel()->getKeyName();
    }

    public function getTableColumns()
    {
        if (!$this->tableColumn) {
            $this->tableColumn = Database::getTableColumns(
                $this->getModel()->getTable(), 
                $this->getModel()->getConnectionName()
            );
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

        $data = $query->find($id);
        
        // 防止数据不存在时报错
        return $data ? $data->makeHidden($hidden) : null;
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
        $schema = $this->resolveListSchema();

        if (!$schema instanceof Page) return;

        // 字段
        $columns = $schema->toArray()['body']->amisSchema['columns'] ?? [];

        $relations = [];
        foreach ($columns as $column) {
            // 排除非表格字段
            if (!$column instanceof TableColumn) continue;
            // 拆分字段名
            $field = $column->amisSchema['name'] ?? null;
            if (!$field) continue;
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
     * 获取当前列表结构
     *
     * @return Page|null
     */
    protected function resolveListSchema(): ?Page
    {
        $route = Route::getCurrentRoute();

        // 命令行或非控制器场景下，当前路由可能不存在
        if (!$route) {
            return null;
        }

        $controller = $route->getController();

        // 路由未绑定控制器时，直接跳过自动关联推导
        if (!$controller || !method_exists($controller, 'list')) {
            return null;
        }

        $schema = $controller->list();

        return $schema instanceof Page ? $schema : null;
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
        $orderBy  = request()->input('orderBy');
        $orderDir = strtolower(request()->input('orderDir', 'asc'));

        if ($orderBy && $this->hasColumn($orderBy)) {
            // 只允许按真实表字段排序，方向也收敛到 asc/desc，避免非法参数进入 SQL。
            $query->orderBy($orderBy, in_array($orderDir, ['asc', 'desc']) ? $orderDir : 'asc');
            return;
        }

        $query->orderByDesc($this->sortColumn());
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
                $query->when(filled(request($field)), function ($query) use ($field) {
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
     * 格式化任意来源的列表数据
     *
     * @param mixed $rows 一次列表查询的数据
     *
     * @return mixed
     */
    public function formatListRows($rows)
    {
        return is_array($rows) ? $this->formatRows($rows) : $rows;
    }

    /**
     * 列表 获取数据
     *
     * @return array
     */
    public function list()
    {
        $query = $this->listQuery();

        $perPage = min(max((int) request()->input('perPage', 20), 1), 100);
        $list    = $query->paginate($perPage);
        $items = $this->formatListRows($list->items());
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
        DB::beginTransaction();
        try {
            $result = $this->saveUpdate($primaryKey, $data);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            admin_abort($e->getMessage());
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
        DB::beginTransaction();
        try {
            $result = $this->saveStore($data);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            admin_abort($e->getMessage());
        }

        return $result;
    }

    /**
     * 给模型填充允许写入的字段，统一新增和修改的数据过滤规则。
     *
     * @param Model $model
     * @param array $data
     *
     * @return Model
     */
    protected function fillModelFromData(Model $model, array $data): Model
    {
        foreach ($data as $k => $v) {
            if (!$this->hasColumn($k)) {
                // 请求里可能包含 amis 动作参数或前端辅助字段，非表字段不能写入模型。
                continue;
            }

            $model->setAttribute($k, $v);
        }

        return $model;
    }

    /**
     * 执行新增保存本体，供普通新增和批量场景复用，事务由外层方法控制。
     *
     * @param array $data
     *
     * @return bool
     */
    protected function saveStore(array $data): bool
    {
        $this->saving($data);

        $model = $this->fillModelFromData($this->getModel(), $data);
        $result = $model->save();

        // 保存后记录当前模型，方便 saved 钩子或外部流程读取本次操作对象。
        $this->currentModel = $model;

        if ($result) {
            // 只有 Eloquent 确认保存成功后才触发后置钩子，避免失败数据进入扩展逻辑。
            $this->saved($model);
        }

        return $result;
    }

    /**
     * 执行修改保存本体，查不到数据时直接中断，避免空模型继续写入导致 fatal。
     *
     * @param $primaryKey
     * @param array $data
     *
     * @return bool
     */
    protected function saveUpdate($primaryKey, array $data): bool
    {
        if (blank($primaryKey)) {
            // 修改必须有主键，空主键不能继续进入查询条件。
            admin_abort(admin_trans('admin.api_templates.primary_key_missing'));
        }

        $this->saving($data, $primaryKey);

        $model = $this->query()->whereKey($primaryKey)->first();

        if (!$model) {
            // 主键无效时属于业务数据缺失，返回明确错误而不是触发空对象调用。
            admin_abort(admin_trans('admin.api_templates.data_missing'));
        }

        $model = $this->fillModelFromData($model, $data);
        $result = $model->save();

        // 无论数据是否变更，都记录当前模型实例，保持原有扩展读取语义。
        $this->currentModel = $model;

        if ($result) {
            // 只有 Eloquent 确认保存成功后才触发后置钩子，避免失败数据进入扩展逻辑。
            $this->saved($model, true);
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
        $ids = collect(explode(',', $ids))->filter(fn($id) => filled($id))->values()->all();

        if (blank($ids)) {
            // 删除请求没有有效主键时直接失败，避免执行空条件删除。
            admin_abort(admin_trans('admin.api_templates.primary_key_missing'));
        }

        DB::beginTransaction();
        try {
            $result = $this->query()->whereIn($this->primaryKey(), $ids)->delete();

            if ($result) {
                $this->deleted(implode(',', $ids));
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            admin_abort($e->getMessage());
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

        DB::beginTransaction();
        try {
            foreach ($rowsDiff as $item) {
                $primaryKey = Arr::pull($item, $this->primaryKey());

                if (blank($primaryKey)) {
                    // 批量快速编辑要求每一行都带主键，否则无法定位具体记录。
                    admin_abort(admin_trans('admin.api_templates.primary_key_missing'));
                }

                $this->saveUpdate($primaryKey, $item);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            admin_abort($e->getMessage());
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
