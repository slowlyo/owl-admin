<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Support\Facades\Hash;
use Slowlyo\OwlAdmin\Models\AdminUser;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method AdminUser getModel()
 * @method AdminUser|Builder query()
 */
class AdminUserService extends AdminService
{
    public function __construct()
    {
        parent::__construct();

        $this->modelName = Admin::adminUserModel();
    }

    public function getEditData($id)
    {
        $adminUser = parent::getEditData($id)->makeHidden('password');

        $adminUser->load('roles');

        return $adminUser;
    }

    public function store($data)
    {
        $this->checkUsernameUnique($data['username']);

        admin_abort_if(!data_get($data, 'password'), admin_trans('admin.required', ['attribute' => admin_trans('admin.password')]));

        $this->passwordHandler($data);

        $columns = $this->getTableColumns();

        $model = $this->getModel();

        return $this->saveData($data, $columns, $model);
    }

    public function update($primaryKey, $data)
    {
        $this->checkUsernameUnique($data['username'], $primaryKey);
        $this->passwordHandler($data);

        $columns = $this->getTableColumns();

        $model = $this->query()->whereKey($primaryKey)->first();

        return $this->saveData($data, $columns, $model);
    }

    public function checkUsernameUnique($username, $id = 0)
    {
        $exists = $this->query()
            ->where('username', $username)
            ->when($id, fn($query) => $query->where('id', '<>', $id))
            ->exists();

        admin_abort_if($exists, admin_trans('admin.admin_user.username_already_exists'));
    }

    public function updateUserSetting($primaryKey, $data): bool
    {
        $this->passwordHandler($data, $primaryKey);

        return parent::update($primaryKey, $data);
    }

    public function passwordHandler(&$data, $id = null)
    {
        $password = Arr::get($data, 'password');

        if ($password) {
            admin_abort_if($password !== Arr::get($data, 'confirm_password'), admin_trans('admin.admin_user.password_confirmation'));

            if ($id) {
                admin_abort_if(!Arr::get($data, 'old_password'), admin_trans('admin.admin_user.old_password_required'));

                $oldPassword = $this->query()->where('id', $id)->value('password');

                admin_abort_if(!Hash::check($data['old_password'], $oldPassword), admin_trans('admin.admin_user.old_password_error'));
            }

            $data['password'] = bcrypt($password);

            unset($data['confirm_password']);
            unset($data['old_password']);
        }
    }

    public function list()
    {
        $keyword = request()->keyword;

        $query = $this->query()
            ->with('roles')
            ->select(['id', 'name', 'username', 'avatar', 'enabled', 'created_at'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('username', 'like', "%{$keyword}%")->orWhere('name', 'like', "%{$keyword}%");
            });

        $this->sortable($query);

        $list  = $query->paginate(request()->input('perPage', 20));
        $items = $list->items();
        $total = $list->total();

        return compact('items', 'total');
    }

    /**
     * @param           $data
     * @param array     $columns
     * @param AdminUser $model
     *
     * @return bool
     */
    protected function saveData($data, array $columns, AdminUser $model)
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

    public function delete(string $ids)
    {
        $exists = $this->query()
            ->whereIn($this->primaryKey(), explode(',', $ids))
            ->whereHas('roles', fn($q) => $q->where('slug', 'administrator'))
            ->exists();

        admin_abort_if($exists, admin_trans('admin.admin_user.cannot_delete'));

        return parent::delete($ids);
    }
}
