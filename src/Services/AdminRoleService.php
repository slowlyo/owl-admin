<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Models\AdminRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Slowlyo\OwlAdmin\Models\AdminPermission;

/**
 * @method AdminRole getModel()
 * @method AdminRole|Builder|QueryBuilder query()
 */
class AdminRoleService extends AdminService
{
    protected string $modelName;

    public function __construct()
    {
        $this->modelName = Admin::adminRoleModel();
    }

    public function getEditData($id): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
    {
        $permission = parent::getEditData($id);

        $p = $permission->permissions->pluck('id')->map(fn ($id)=> 'p:'. $id)->values();
        $m = $permission->menus->pluck('id')->map(fn ($id)=> 'm:'. $id)->values();
        unset($permission->permissions, $permission->menus);
        $permission->permissions = collect([...$p, ...$m]);

        return $permission;
    }

    public function store($data): bool
    {
        if ($this->hasRepeated($data)) {
            return false;
        }

        $columns = $this->getTableColumns();

        $model = $this->getModel();

        foreach ($data as $k => $v) {
            if (!in_array($k, $columns)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        return $model->save();
    }

    public function update($primaryKey, $data): bool
    {
        if ($this->hasRepeated($data, $primaryKey)) {
            return false;
        }

        $columns = $this->getTableColumns();

        $model = $this->query()->whereKey($primaryKey)->first();

        foreach ($data as $k => $v) {
            if (!in_array($k, $columns)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        return $model->save();
    }

    public function hasRepeated($data, $id = 0): bool
    {
        $query = $this->query()->when($id, fn($query) => $query->where('id', '<>', $id));

        if ((clone $query)->where('name', $data['name'])->exists()) {
            $this->setError(__('admin.admin_role.name_already_exists'));
            return true;
        }

        if ((clone $query)->where('slug', $data['slug'])->exists()) {
            $this->setError(__('admin.admin_role.slug_already_exists'));
            return true;
        }

        return false;
    }

    public function savePermissions($primaryKey, $permissions)
    {
        $model = $this->query()->whereKey($primaryKey)->first();
        $permission_ids = [];
        $menu_ids = [];
        foreach($permissions as $tag){
            if(str_contains($tag, 'm:')){
                $menu_ids[] = explode(':', $tag)[1];
            }
            if(str_contains($tag, 'p:')){
                $permission_ids[] = explode(':', $tag)[1];
            }
        }

        $model->permissions()->sync($permission_ids);
        $model->menus()->sync($menu_ids);
        return true;
    }

    public function getMenuPermission()
    {
        $mp = Admin::adminMenuModel()::query()
            ->with(['permissions:id,name,menu_id'])
            ->orderBy('order')
            ->get(['id', 'parent_id', 'title as name', 'order']);

        $mp->map(function($item){
            $item->name = __('menu.' . $item->name);
            $item->children = $item->permissions;
            $item->children->map(fn($permission)=>$permission->tag = 'p:' . $permission->id);
            $item->tag = 'm:' . $item->id;
            unset($item->permissions);
        });
        
        return array2tree($mp->toArray());
    }
}
