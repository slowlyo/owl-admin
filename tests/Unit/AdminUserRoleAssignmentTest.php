<?php

namespace Slowlyo\OwlAdmin\Tests\Unit;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Exceptions\AdminException;
use Slowlyo\OwlAdmin\Models\AdminRole;
use Slowlyo\OwlAdmin\Models\AdminUser;
use Slowlyo\OwlAdmin\Services\AdminUserService;
use Slowlyo\OwlAdmin\Support\Cores\Database;
use Slowlyo\OwlAdmin\Tests\TestCase;

class AdminUserRoleAssignmentTest extends TestCase
{
    private AdminUserService $service;

    /**
     * 每个用例使用独立内存库并预置超管、普通角色与对应用户。
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
        ]);

        AdminUser::query()->find(1)->roles()->sync([1]);
        AdminUser::query()->find(2)->roles()->sync([2]);

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
     * 非超管在创建用户时绑定超管角色应被拒绝。
     */
    public function test_non_administrator_cannot_assign_super_administrator_role_on_store(): void
    {
        $this->actingAsAdminUser(2);

        $this->expectException(AdminException::class);

        $this->service->store([
            'username'         => 'evil',
            'name'             => 'Evil',
            'password'         => 'password',
            'confirm_password' => 'password',
            'roles'            => [1],
        ]);
    }

    /**
     * 非超管只能绑定自己已有的角色，创建用户时应成功。
     */
    public function test_non_administrator_can_assign_own_role_on_store(): void
    {
        $this->actingAsAdminUser(2);

        $result = $this->service->store([
            'username'         => 'new_editor',
            'name'             => 'New Editor',
            'password'         => 'password',
            'confirm_password' => 'password',
            'roles'            => [2],
        ]);

        $this->assertTrue($result);

        $created = AdminUser::query()->where('username', 'new_editor')->first();
        $this->assertNotNull($created);
        $this->assertSame([2], $created->roles()->pluck('id')->all());
    }

    /**
     * 超级管理员仍可授予超管角色。
     */
    public function test_administrator_can_assign_super_administrator_role_on_store(): void
    {
        $this->actingAsAdminUser(1);

        $result = $this->service->store([
            'username'         => 'another_admin',
            'name'             => 'Another Admin',
            'password'         => 'password',
            'confirm_password' => 'password',
            'roles'            => [1],
        ]);

        $this->assertTrue($result);

        $created = AdminUser::query()->where('username', 'another_admin')->first();
        $this->assertNotNull($created);
        $this->assertTrue($created->isAdministrator());
    }

    /**
     * 更新用户时同样应拦截越权角色绑定。
     */
    public function test_non_administrator_cannot_assign_super_administrator_role_on_update(): void
    {
        $this->actingAsAdminUser(2);

        $targetId = AdminUser::query()->insertGetId([
            'username'   => 'victim',
            'password'   => bcrypt('password'),
            'name'       => 'Victim',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        AdminUser::query()->find($targetId)->roles()->sync([2]);

        $this->expectException(AdminException::class);

        $this->service->update($targetId, [
            'username' => 'victim',
            'name'     => 'Victim',
            'roles'    => [1],
        ]);
    }
}
