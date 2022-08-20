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
}
