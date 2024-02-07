<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Database\Eloquent\Builder;
use Slowlyo\OwlAdmin\Models\AdminPermission;

/**
 * @method AdminPermission getModel()
 * @method AdminPermission|Builder query()
 */
class AdminPermissionService extends AdminService
{
    public function __construct()
    {
        $this->modelName = Admin::adminPermissionModel();
    }

    public function getTree()
    {
        $list = $this->query()->orderBy('order')->get()->toArray();

        return array2tree($list);
    }

    public function parentIsChild($id, $parent_id)
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

    public function getEditData($id)
    {
        $permission = parent::getEditData($id);

        $permission->load(['menus']);

        return $permission;
    }

    public function store($data)
    {
        $this->checkRepeated($data);

        $columns = $this->getTableColumns();

        $model = $this->getModel();

        return $this->saveData($data, $columns, $model);
    }

    public function update($primaryKey, $data)
    {
        $this->checkRepeated($data, $primaryKey);

        $columns = $this->getTableColumns();

        $parent_id = Arr::get($data, 'parent_id');
        if ($parent_id != 0) {
            amis_abort_if($this->parentIsChild($primaryKey, $parent_id), __('admin.admin_permission.parent_id_not_allow'));
        }

        $model = $this->query()->whereKey($primaryKey)->first();

        return $this->saveData($data, $columns, $model);
    }

    public function checkRepeated($data, $id = 0)
    {
        $query = $this->query()->when($id, fn($query) => $query->where('id', '<>', $id));

        amis_abort_if($query->clone()->where('name', $data['name'])
            ->exists(), __('admin.admin_permission.name_already_exists'));

        amis_abort_if($query->clone()->where('slug', $data['slug'])
            ->exists(), __('admin.admin_permission.slug_already_exists'));
    }

    public function list()
    {
        return ['items' => $this->getTree()];
    }

    /**
     * @param                 $data
     * @param array           $columns
     * @param AdminPermission $model
     *
     * @return bool
     */
    protected function saveData($data, array $columns, AdminPermission $model)
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
