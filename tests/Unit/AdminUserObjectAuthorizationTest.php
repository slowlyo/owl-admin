<?php

namespace Slowlyo\OwlAdmin\Tests\Unit;

use Illuminate\Support\Facades\Hash;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Exceptions\AdminException;
use Slowlyo\OwlAdmin\Models\AdminRole;
use Slowlyo\OwlAdmin\Models\AdminUser;
use Slowlyo\OwlAdmin\Services\AdminUserService;
use Slowlyo\OwlAdmin\Support\Cores\Database;
use Slowlyo\OwlAdmin\Tests\TestCase;

class AdminUserObjectAuthorizationTest extends TestCase
{
    private AdminUserService $service;

    /**
     * 每个用例使用独立内存库并预置超管、编辑角色及对应用户。
     */
    protected function setUp(): void
    {
        parent::setUp();

        Database::make()->up();

        $now = now();

        AdminRole::query()->insert([
            [
                'id'         => 1,
                'name'       => 'Administrator',
                'slug'       => AdminRole::SuperAdministrator,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => 'Editor',
                'slug'       => 'editor',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 3,
                'name'       => 'Viewer',
                'slug'       => 'viewer',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        AdminUser::query()->insert([
            [
                'id'         => 1,
                'username'   => 'super',
                'password'   => bcrypt('password'),
                'name'       => 'Super',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'username'   => 'editor',
                'password'   => bcrypt('password'),
                'name'       => 'Editor User',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 3,
                'username'   => 'viewer',
                'password'   => bcrypt('password'),
                'name'       => 'Viewer User',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        AdminUser::query()->find(1)->roles()->sync([1]);
        AdminUser::query()->find(2)->roles()->sync([2]);
        AdminUser::query()->find(3)->roles()->sync([3]);

        $this->service = new AdminUserService();
    }

    /**
     * 以指定管理员身份执行后续 service 调用。
     */
    private function actingAsAdminUser(int $userId): AdminUser
    {
        $user = AdminUser::query()->with('roles')->findOrFail($userId);
        $this->actingAs($user, Admin::config('admin.auth.guard'));

        return $user;
    }

    /**
     * 低权限管理员不能修改超级管理员密码（无需旧密码的管理员改密路径仍须对象级授权）。
     */
    public function test_non_administrator_cannot_update_super_administrator_password(): void
    {
        $this->actingAsAdminUser(2);

        $this->expectException(AdminException::class);

        $this->service->update(1, [
            'username'         => 'super',
            'name'             => 'Super',
            'password'         => 'Hijacked1!',
            'confirm_password' => 'Hijacked1!',
        ]);
    }

    /**
     * 不能修改与自己角色无交集的用户。
     */
    public function test_non_administrator_cannot_update_user_outside_role_scope(): void
    {
        $this->actingAsAdminUser(2);

        $this->expectException(AdminException::class);

        $this->service->update(3, [
            'username' => 'viewer',
            'name'     => 'Viewer User',
        ]);
    }

    /**
     * 不能加载超管编辑数据。
     */
    public function test_non_administrator_cannot_load_super_administrator_edit_data(): void
    {
        $this->actingAsAdminUser(2);

        $this->expectException(AdminException::class);

        $this->service->getEditData(1);
    }

    /**
     * 同角色范围内的用户可被更新，且管理员改密仍无需旧密码。
     */
    public function test_non_administrator_can_reset_password_for_user_in_same_role_scope(): void
    {
        $this->actingAsAdminUser(2);

        $peerId = AdminUser::query()->insertGetId([
            'username'   => 'peer_editor',
            'password'   => bcrypt('password'),
            'name'       => 'Peer Editor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        AdminUser::query()->find($peerId)->roles()->sync([2]);

        $result = $this->service->update($peerId, [
            'username'         => 'peer_editor',
            'name'             => 'Peer Editor',
            'password'         => 'new-secret',
            'confirm_password' => 'new-secret',
        ]);

        $this->assertTrue($result);
        $this->assertTrue(Hash::check('new-secret', AdminUser::query()->find($peerId)->password));
    }

    /**
     * 超级管理员仍可重置任意用户密码。
     */
    public function test_administrator_can_update_any_user_password(): void
    {
        $this->actingAsAdminUser(1);

        $result = $this->service->update(2, [
            'username'         => 'editor',
            'name'             => 'Editor User',
            'password'         => 'admin-reset',
            'confirm_password' => 'admin-reset',
        ]);

        $this->assertTrue($result);
        $this->assertTrue(Hash::check('admin-reset', AdminUser::query()->find(2)->password));
    }

    /**
     * 自助改密仍要求旧密码。
     */
    public function test_update_user_setting_still_requires_old_password(): void
    {
        $this->actingAsAdminUser(2);

        $this->expectException(AdminException::class);

        $this->service->updateUserSetting(2, [
            'password'         => 'self-new',
            'confirm_password' => 'self-new',
        ]);
    }
}
