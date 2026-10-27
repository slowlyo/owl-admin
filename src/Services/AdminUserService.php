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
        $this->assertCurrentUserCanManageUserIds([$id]);

        $adminUser = parent::getEditData($id);

        if ($adminUser === null) {
            return null;
        }

        $adminUser->makeHidden('password');
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
        $this->assertCurrentUserCanManageUserIds([$primaryKey]);

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

        $this->applyNonAdministratorUserScope($query);

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
        $this->assertCurrentUserCanAssignRoles($this->normalizeRoleIds($roles));

        foreach ($data as $k => $v) {
            if (!in_array($k, $columns)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        if ($model->save()) {
            $roleIds = $this->normalizeRoleIds($roles);
            if ($roleIds !== null) {
                $model->roles()->sync($roleIds);
            }

            return true;
        }

        return false;
    }

    /**
     * 将请求中的 roles 字段统一为角色 ID 列表，便于授权校验与 sync 共用同一套解析规则。
     *
     * @param mixed $roles
     * @return array<int, mixed>|null 未传 roles 时返回 null，表示不改动现有关联
     */
    protected function normalizeRoleIds($roles): ?array
    {
        if ($roles === null) {
            return null;
        }

        if (is_array($roles) && Arr::has($roles, '0.id')) {
            return Arr::pluck($roles, 'id');
        }

        return is_array($roles) ? $roles : [$roles];
    }

    /**
     * 非超级管理员只能为自己已拥有的角色做绑定，策略与 roleOptions 一致，防止越权提权。
     *
     * @param array<int, mixed>|null $roleIds
     */
    protected function assertCurrentUserCanAssignRoles(?array $roleIds): void
    {
        if ($roleIds === null) {
            return;
        }

        $roleIds = array_values(array_filter($roleIds, fn ($id) => $id !== null && $id !== ''));
        if ($roleIds === []) {
            return;
        }

        $currentUser = Admin::user();
        if ($currentUser === null || $currentUser->isAdministrator()) {
            return;
        }

        $assignableRoleIds = $currentUser->roles()->pluck('id')->map(fn ($id) => (int) $id)->all();
        $requestedRoleIds  = array_map(fn ($id) => (int) $id, $roleIds);

        $unauthorizedRoleIds = array_diff($requestedRoleIds, $assignableRoleIds);

        admin_abort_if(
            $unauthorizedRoleIds !== [],
            admin_trans('admin.admin_user.roles_not_assignable')
        );
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
        $idList = collect(explode(',', $ids))->filter(fn ($id) => filled($id))->values()->all();

        $this->assertCurrentUserCanManageUserIds($idList);

        $exists = $this
            ->query()
            ->whereIn($this->primaryKey(), $idList)
            ->whereHas('roles', fn($q) => $q->where('slug', AdminRole::SuperAdministrator))
            ->exists();

        admin_abort_if($exists, admin_trans('admin.admin_user.cannot_delete'));

        return parent::delete($ids);
    }

    /**
     * 非超级管理员的用户可见/可操作范围：与列表一致，仅能管理与自己角色有交集且非超管角色的账号。
     */
    protected function applyNonAdministratorUserScope(Builder $query): Builder
    {
        $currentUser = Admin::user();
        if ($currentUser === null || $currentUser->isAdministrator()) {
            return $query;
        }

        $query->whereHas('roles', function ($query) use ($currentUser) {
            $query->whereIn('id', $currentUser->roles()->pluck('id'));
        })->whereDoesntHave('roles', fn ($q) => $q->where('slug', AdminRole::SuperAdministrator));

        return $query;
    }

    /**
     * 单条或批量操作前校验目标用户是否落在当前操作者的可管理范围内。
     *
     * @param array<int|string> $ids
     */
    protected function assertCurrentUserCanManageUserIds(array $ids): void
    {
        $ids = array_values(array_filter($ids, fn ($id) => $id !== null && $id !== ''));
        if ($ids === []) {
            return;
        }

        $currentUser = Admin::user();
        if ($currentUser === null || $currentUser->isAdministrator()) {
            return;
        }

        $manageableIds = $this->applyNonAdministratorUserScope($this->query())
            ->whereIn($this->primaryKey(), $ids)
            ->pluck($this->primaryKey())
            ->map(fn ($id) => (string) $id)
            ->all();

        $requestedIds = array_map(fn ($id) => (string) $id, $ids);
        $unauthorizedIds = array_diff($requestedIds, $manageableIds);

        admin_abort_if(
            $unauthorizedIds !== [],
            admin_trans('admin.admin_user.cannot_manage')
        );
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
