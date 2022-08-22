<?php

namespace Slowlyo\SlowAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\SlowAdmin\Models\AdminRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AdminRoleService extends AdminService
{
    protected string $modelName = AdminRole::class;

    public function getEditData($id): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
    {
        $permission = parent::getEditData($id);

        $permission->load(['permissions']);

        return $permission;
    }

    public function store($data): bool
    {
        if ($this->hasRepeated($data)) {
            return false;
        }

        $model = $this->getModel();

        $permissions = Arr::pull($data, 'permissions');

        foreach ($data as $k => $v) {
            $model->setAttribute($k, $v);
        }

        if ($model->save()) {
            $model->permissions()->sync(Arr::has($permissions, '0.id') ? Arr::pluck($permissions, 'id') : $permissions);

            return true;
        }

        return false;
    }

    public function update($primaryKey, $data): bool
    {
        if ($this->hasRepeated($data, $primaryKey)) {
            return false;
        }

        $model = $this->query()->whereKey($primaryKey)->first();

        $permissions = Arr::pull($data, 'permissions');

        foreach ($data as $k => $v) {
            $model->setAttribute($k, $v);
        }

        if ($model->save()) {
            $model->permissions()->sync(Arr::has($permissions, '0.id') ? Arr::pluck($permissions, 'id') : $permissions);

            return true;
        }

        return false;
    }

    public function hasRepeated($data, $id = 0): bool
    {
        $query = $this->query()->when($id, fn($query) => $query->where('id', '<>', $id));

        if ((clone $query)->where('name', $data['name'])->exists()) {
            $this->setError('角色名称重复');
            return true;
        }

        if ((clone $query)->where('slug', $data['slug'])->exists()) {
            $this->setError('角色标识重复');
            return true;
        }

        return false;
    }
}
