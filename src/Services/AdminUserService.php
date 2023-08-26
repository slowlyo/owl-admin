<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Support\Facades\Hash;
use Slowlyo\OwlAdmin\Models\AdminUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method AdminUser getModel()
 * @method AdminUser|Builder query()
 */
class AdminUserService extends AdminService
{
    protected string $modelName;

    public function __construct()
    {
        $this->modelName = Admin::adminUserModel();
    }

    public function getEditData($id): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
    {
        $adminUser = parent::getEditData($id)->makeHidden('password');

        $adminUser->load('roles');

        return $adminUser;
    }

    public function store($data): bool
    {
        if ($this->checkUsernameUnique($data['username'])) {
            return $this->setError(__('admin.admin_user.username_already_exists'));
        }

        if (!data_get($data, 'password')) {
            return $this->setError(__('admin.required', ['attribute' => __('admin.password')]));
        }

        if (!$this->passwordHandler($data)) {
            return false;
        }

        $columns = $this->getTableColumns();

        $model = $this->getModel();

        return $this->saveData($data, $columns, $model);
    }

    public function update($primaryKey, $data): bool
    {
        if ($this->checkUsernameUnique($data['username'], $primaryKey)) {
            return $this->setError(__('admin.admin_user.username_already_exists'));
        }

        if (!$this->passwordHandler($data)) {
            return false;
        }

        $columns = $this->getTableColumns();

        $model = $this->query()->whereKey($primaryKey)->first();

        return $this->saveData($data, $columns, $model);
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
        if (!$this->passwordHandler($data, $primaryKey)) {
            return false;
        }

        return parent::update($primaryKey, $data);
    }

    public function passwordHandler(&$data, $id = null): bool
    {
        $password = Arr::get($data, 'password');

        if ($password) {
            if ($password !== Arr::get($data, 'confirm_password')) {
                return $this->setError(__('admin.admin_user.password_confirmation'));
            }

            if ($id) {
                if (!Arr::get($data, 'old_password')) {
                    return $this->setError(__('admin.admin_user.old_password_required'));
                }

                $oldPassword = $this->query()->where('id', $id)->value('password');

                if (!Hash::check($data['old_password'], $oldPassword)) {
                    return $this->setError(__('admin.admin_user.old_password_error'));
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

        $this->sortable($query);

        $items = (clone $query)->paginate(request()->input('perPage', 20))->items();
        $total = (clone $query)->count();

        return compact('items', 'total');
    }

    /**
     * @param           $data
     * @param array     $columns
     * @param AdminUser $model
     *
     * @return bool
     */
    protected function saveData($data, array $columns, AdminUser $model): bool
    {
        $roles = Arr::pull($data, 'roles');

        foreach ($data as $k => $v) {
            if (!in_array($k, $columns)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        if ($model->save()) {
            $model->roles()->sync(Arr::has($roles, '0.id') ? Arr::pluck($roles, 'id') : $roles);

            return true;
        }

        return false;
    }
}
