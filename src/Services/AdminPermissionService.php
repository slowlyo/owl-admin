<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Slowlyo\OwlAdmin\Models\AdminPermission;

/**
 * @method AdminPermission getModel()
 * @method AdminPermission|Builder query()
 */
class AdminPermissionService extends AdminService
{
    protected string $modelName;

    public function __construct()
    {
        $this->modelName = Admin::adminPermissionModel();
    }

    public function getTree(): array
    {
        $list = $this->query()->orderBy('order')->get()->toArray();

        return array2tree($list);
    }

    public function parentIsChild($id, $parent_id): bool
    {
        $parent = $this->query()->find($parent_id);

        do {
            if ($parent->parent_id == $id) {
                return true;
            }
            // 如果没有parent 则为顶级 退出循环
            $parent = $parent->parent;
        } while ($parent);

        return false;
    }

    public function getEditData($id): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
    {
        $permission = parent::getEditData($id);

        $permission->load(['menus']);

        return $permission;
    }

    public function store($data): bool
    {
        if ($this->hasRepeated($data)) {
            return false;
        }

        $columns = $this->getTableColumns();

        $model = $this->getModel();

        return $this->saveData($data, $columns, $model);
    }

    public function update($primaryKey, $data): bool
    {
        if ($this->hasRepeated($data, $primaryKey)) {
            return false;
        }

        $columns = $this->getTableColumns();

        $parent_id = Arr::get($data, 'parent_id');
        if ($parent_id != 0) {
            if ($this->parentIsChild($primaryKey, $parent_id)) {
                return $this->setError(__('admin.admin_permissions.parent_id_not_allow'));
            }
        }

        $model = $this->query()->whereKey($primaryKey)->first();

        return $this->saveData($data, $columns, $model);
    }

    public function hasRepeated($data, $id = 0): bool
    {
        $query = $this->query()->when($id, fn($query) => $query->where('id', '<>', $id));

        if ((clone $query)->where('name', $data['name'])->exists()) {
            $this->setError(__('admin.admin_permission.name_already_exists'));
            return true;
        }

        if ((clone $query)->where('slug', $data['slug'])->exists()) {
            $this->setError(__('admin.admin_permission.slug_already_exists'));
            return true;
        }

        return false;
    }

    public function list()
    {
        return ['items' => $this->getTree()];
    }

    /**
     * @param $data
     * @param array $columns
     * @param AdminPermission $model
     *
     * @return bool
     */
    protected function saveData($data, array $columns, AdminPermission $model): bool
    {
        $menus = Arr::pull($data, 'menus');

        foreach ($data as $k => $v) {
            if (!in_array($k, $columns)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        if ($model->save()) {
            $model->menus()->sync(Arr::has($menus, '0.id') ? Arr::pluck($menus, 'id') : $menus);

            return true;
        }

        return false;
    }
}
