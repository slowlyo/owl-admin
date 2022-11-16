<?php

namespace Slowlyo\SlowAdmin\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Slowlyo\SlowAdmin\Models\AdminUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AdminUserService extends AdminService
{
    protected string $modelName = AdminUser::class;

    public function getEditData($id): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
    {
        $adminUser = parent::getEditData($id)->makeHidden('password');

        $adminUser->load('roles');

        return $adminUser;
    }

    public function store($data): bool
    {
        if ($this->checkUsernameUnique($data['username'])) {
            $this->setError('用户名已存在');
            return false;
        }

        if (!$this->passwordHandler($data)) {
            return false;
        }

        $model = $this->getModel();

        $roles = Arr::pull($data, 'roles');

        foreach ($data as $k => $v) {
            $model->setAttribute($k, $v);
        }

        if ($model->save()) {
            $model->roles()->sync(Arr::has($roles, '0.id') ? Arr::pluck($roles, 'id') : $roles);

            return true;
        }

        return false;
    }

    public function update($primaryKey, $data): bool
    {
        if ($this->checkUsernameUnique($data['username'], $primaryKey)) {
            $this->setError('用户名已存在');
            return false;
        }

        if (!$this->passwordHandler($data)) {
            return false;
        }

        $model = $this->query()->whereKey($primaryKey)->first();

        $roles = Arr::pull($data, 'roles');

        foreach ($data as $k => $v) {
            $model->setAttribute($k, $v);
        }

        if ($model->save()) {
            $model->roles()->sync(Arr::has($roles, '0.id') ? Arr::pluck($roles, 'id') : $roles);

            return true;
        }

        return false;
    }

    public function checkUsernameUnique($username, $id = 0): bool
    {
        return $this->query()
            ->where('username', $username)
            ->when($id, fn($query) => $query->where('id', '<>', $id))
            ->exists();
    }

    public function updateUserSetting($primaryKey, $data): bool
    {
        if (!$this->passwordHandler($primaryKey, $data)) {
            return false;
        }

        return parent::update($primaryKey, $data);
    }

    public function passwordHandler(&$data, $id = null): bool
    {
        $password = Arr::get($data, 'password');

        if ($password) {
            if ($password !== Arr::get($data, 'confirm_password')) {
                return $this->setError('两次输入密码不一致');
            }

            if ($id) {
                if (!Arr::get($data, 'old_password')) {
                    return $this->setError('请输入原密码');
                }

                $oldPassword = $this->query()->where('id', $id)->value('password');

                if (!Hash::check($data['old_password'], $oldPassword)) {
                    return $this->setError('密码错误');
                }
            }

            $data['password'] = bcrypt($password);

            unset($data['confirm_password']);
            unset($data['old_password']);
        }

        return true;
    }

    public function list()
    {
        $keyword = request()->keyword;

        $query = $this
            ->query()
            ->with('roles')
            ->select(['id', 'name', 'username', 'avatar', 'created_at'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('username', 'like', "%{$keyword}%")->orWhere('name', 'like', "%{$keyword}%");
            });

        $items = (clone $query)->paginate(request()->input('perPage', 20))->items();
        $total = (clone $query)->count();

        return compact('items', 'total');
    }
}
