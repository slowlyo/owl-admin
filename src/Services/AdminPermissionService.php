<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Str;
use Slowlyo\OwlAdmin\Models\AdminPermission;

/**
 * @method AdminPermission getModel()
 * @method AdminPermission|Builder|QueryBuilder query()
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
        $list = $this->query()->orderBy('menu_id')->with('menu:id,title,url')->get();
        $tree = collect([]);
        $list->groupBy('menu_id')
            ->map(function ($item, $key) use ($tree) {
                if ($key == 0) {
                    $tree->push(...$item);
                } else {
                    $menu = $item->first()->menu;
                    $tree->push(['id' => 0, 'name' => $menu->title, 'children' => $item, 'http_path' => [$menu->url]]);
                }
            });

        return $tree->toArray();
    }

    public function store($data): bool
    {
        $base_permission = Arr::pull($data, 'base_permission');
        $extra_permission = Arr::pull($data, 'extra_permission');
        $permissions = collect();
        $menu_id = Arr::pull($data, 'menu.id');
        $path = Arr::pull($data, 'menu.url');

        if (!empty($extra_permission)) {
            foreach ($extra_permission as $permission) {
                $permission['slug'] = Str::uuid();
                $permission['menu_id'] = $menu_id;
                $permissions->push($permission);
            }
        }

        if (!empty($base_permission)) {
            foreach ($base_permission as $base) {
                $permission = match ($base) {
                    'show'      => ['name' => '详情', 'slug' => Str::uuid(), 'http_path' => ['get:' . $path], 'menu_id' => $menu_id],
                    'create'    => ['name' => '新增', 'slug' => Str::uuid(), 'http_path' => ['post:' . $path], 'menu_id' => $menu_id],
                    'edit'      => ['name' => '编辑', 'slug' => Str::uuid(), 'http_path' => ['get:' . $path . '/*/edit', 'put:'. $path . '/*'], 'menu_id' => $menu_id],
                    'export'    => ['name' => '导出', 'slug' => Str::uuid(), 'http_path' => ['get:' . $path], 'menu_id' => $menu_id],
                    'delete'    => ['name' => '删除', 'slug' => Str::uuid(), 'http_path' => ['delete:' . $path . '/*'], 'menu_id' => $menu_id],
                    'batchDel'  => ['name' => '批量删除', 'slug' => Str::uuid(), 'http_path' => ['delete:' . $path . '/*'], 'menu_id' => $menu_id],
                    default => null,
                };
                $permission && $permissions->push($permission);
            }
        }

        if($permissions->isNotEmpty()){
            $permissions->push(['name' => '列表', 'slug' => Str::uuid(), 'http_path' => ['get:' . $path], 'menu_id' => $menu_id]);
        }

        $permissions = $permissions->map(function($item){
            $item['http_path'] = json_encode($item['http_path']??[]);
            return $item;
        })->all();
        
        $this->getModel()->insert($permissions);

        return true;
    }

    public function update($primaryKey, $data): bool
    {
        if ($this->hasRepeated($data, $primaryKey)) {
            return false;
        }

        $data['menu_id'] = $data['menu_id'] ?: 0;

        $columns = $this->getTableColumns();

        $model = $this->query()->whereKey($primaryKey)->first();

        return $this->saveData($data, $columns, $model);
    }

    public function hasRepeated($data, $id = 0): bool
    {
        $query = $this->query()->when($id, fn ($query) => $query->where('id', '<>', $id));

        // if ((clone $query)->where('name', $data['name'])->exists()) {
        //     $this->setError(__('admin.admin_permission.name_already_exists'));
        //     return true;
        // }

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
        // $menus = Arr::pull($data, 'menus');

        foreach ($data as $k => $v) {
            if (!in_array($k, $columns)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        if ($model->save()) {
            // $model->menus()->sync(Arr::has($menus, '0.id') ? Arr::pluck($menus, 'id') : $menus);

            return true;
        }

        return false;
    }
}
