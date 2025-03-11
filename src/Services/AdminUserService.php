<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Support\Facades\Hash;
use Slowlyo\OwlAdmin\Models\AdminUser;
use Slowlyo\OwlAdmin\Models\AdminRole;
use Illuminate\Database\Eloquent\Builder;

/**
 * 管理员用户服务类
 * 
 * @method AdminUser getModel()
 * @method AdminUser|Builder query()
 */
class AdminUserService extends AdminService
{
    /**
     * 构造函数
     * 初始化父类并设置模型名称
     */
    public function __construct()
    {
        parent::__construct();

        $this->modelName = Admin::adminUserModel();
    }

    /**
     * 获取编辑数据
     * 重写父类方法，隐藏密码字段并加载角色关联
     */
    public function getEditData($id)
    {
        $adminUser = parent::getEditData($id)->makeHidden('password');

        $adminUser->load('roles');

        return $adminUser;
    }

    /**
     * 创建管理员用户
     * 
     * @param array $data 用户数据
     * @return bool
     */
    public function store($data)
    {
        $this->checkUsernameUnique($data['username']);

        admin_abort_if(!data_get($data, 'password'), admin_trans('admin.required', ['attribute' => admin_trans('admin.password')]));

        $this->passwordHandler($data);

        return $this->saveData($data);
    }

    /**
     * 更新管理员用户
     * 
     * @param mixed $primaryKey 主键
     * @param array $data 更新数据
     * @return bool
     */
    public function update($primaryKey, $data)
    {
        $this->checkUsernameUnique($data['username'], $primaryKey);
        $this->passwordHandler($data);

        return $this->saveData($data, $primaryKey);
    }

    /**
     * 检查用户名是否唯一
     * 
     * @param string $username 用户名
     * @param int $id 排除的用户ID
     */
    public function checkUsernameUnique($username, $id = 0)
    {
        $exists = $this
            ->query()
            ->where('username', $username)
            ->when($id, fn($query) => $query->where('id', '<>', $id))
            ->exists();

        admin_abort_if($exists, admin_trans('admin.admin_user.username_already_exists'));
    }

    /**
     * 更新用户设置
     * 
     * @param mixed $primaryKey 主键
     * @param array $data 设置数据
     * @return bool
     */
    public function updateUserSetting($primaryKey, $data): bool
    {
        $this->passwordHandler($data, $primaryKey);

        return parent::update($primaryKey, $data);
    }

    /**
     * 密码处理
     * 包括密码确认、旧密码验证和加密
     * 
     * @param array $data 引用传递的数据数组
     * @param int|null $id 用户ID
     */
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

    /**
     * 列表查询
     * 重写父类方法，添加关联加载和各种筛选条件
     * 
     * @return Builder
     */
    public function listQuery()
    {
        $query = parent::listQuery()
            ->with('roles')
            ->select(['id', 'name', 'username', 'avatar', 'enabled', 'created_at']);

        // 非超级管理员只能看到自己拥有的角色
        if (!Admin::user()->isAdministrator()) {
            $query->whereHas('roles', function ($query) {
                $query->whereIn('id', Admin::user()->roles()->pluck('id'));
            });
        }

        // 用户名搜索
        if ($username = request()->username) {
            $query->where('username', 'like', "%{$username}%");
        }

        // 真实姓名搜索
        if ($name = request()->name) {
            $query->where('name', 'like', "%{$name}%");
        }

        // 角色筛选
        if ($roles = request()->roles) {
            $roleIds = is_array($roles) ? $roles : [$roles];
            $query->whereHas('roles', function ($query) use ($roleIds) {
                $query->whereIn('id', $roleIds);
            });
        }

        // 状态筛选
        if (request()->filled('enabled')) {
            $query->where('enabled', request()->enabled);
        }

        // 创建时间范围筛选
        if ($created_at = request()->created_at) {
            $dates = safe_explode(',', $created_at);
            if (count($dates) == 2) {
                $query->whereBetween('created_at', [
                    $dates[0] . ' 00:00:00',
                    $dates[1] . ' 23:59:59'
                ]);
            }
        }

        return $query;
    }

    /**
     * 保存数据
     * 处理模型属性和角色关联的保存
     * 
     * @param array $data 保存的数据
     * @param mixed|null $primaryKey 主键
     * @return bool
     */
    protected function saveData($data, $primaryKey = null)
    {
        $model = $primaryKey ? $this->query()->find($primaryKey) : $this->getModel();
        $columns = $this->getTableColumns();

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

    /**
     * 删除用户
     * 禁止删除超级管理员
     * 
     * @param string $ids 要删除的用户ID，多个ID用逗号分隔
     * @return mixed
     */
    public function delete(string $ids)
    {
        $exists = $this
            ->query()
            ->whereIn($this->primaryKey(), explode(',', $ids))
            ->whereHas('roles', fn($q) => $q->where('slug', AdminRole::SuperAdministrator))
            ->exists();

        admin_abort_if($exists, admin_trans('admin.admin_user.cannot_delete'));

        return parent::delete($ids);
    }

    /**
     * 获取角色选项
     * 非超级管理员用户只能看到自己拥有的角色
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function roleOptions()
    {
        $query = AdminRoleService::make()->query();

        // 非超级管理员只能看到自己拥有的角色
        if (!Admin::user()->isAdministrator()) {
            $query->whereIn('id', Admin::user()->roles()->pluck('id'));
        }

        return $query->get(['id', 'name']);
    }
}
