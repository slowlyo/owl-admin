<?php

namespace Slowlyo\OwlAdmin\Tests\Unit;

use Illuminate\Support\Facades\Hash;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Models\AdminRole;
use Slowlyo\OwlAdmin\Models\AdminUser;
use Slowlyo\OwlAdmin\Models\Extension;
use Slowlyo\OwlAdmin\Services\AdminService;
use Slowlyo\OwlAdmin\Services\AdminUserService;
use Slowlyo\OwlAdmin\Support\Cores\Database;
use Slowlyo\OwlAdmin\Tests\TestCase;

class AdminMassAssignmentTest extends TestCase
{
    /**
     * 每个用例使用独立内存库并预置基础数据。
     */
    protected function setUp(): void
    {
        parent::setUp();

        Database::make()->up();

        $now = now();

        AdminRole::query()->insert([
            'id'         => 1,
            'name'       => 'Administrator',
            'slug'       => AdminRole::SuperAdministrator,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        AdminUser::query()->insert([
            'id'         => 1,
            'username'   => 'super',
            'password'   => bcrypt('password'),
            'name'       => 'Super',
            'enabled'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        AdminUser::query()->find(1)->roles()->sync([1]);
    }

    /**
     * 以超级管理员身份执行后续 service 调用。
     */
    private function actingAsSuperAdmin(): void
    {
        $user = AdminUser::query()->with('roles')->findOrFail(1);
        $this->actingAs($user, Admin::config('admin.auth.guard'));
    }

    /**
     * 基类 CRUD 应忽略客户端提交的主键与 remember_token，但保留正常字段。
     */
    public function test_fill_model_from_data_rejects_primary_key_and_remember_token_on_store(): void
    {
        $service = new class extends AdminService {
            public function __construct()
            {
                parent::__construct();
                $this->modelName = Extension::class;
            }
        };

        $this->assertTrue($service->store([
            'name'       => 'probe-ext',
            'is_enabled' => 1,
            'id'         => 4242,
        ]));

        $created = Extension::query()->where('name', 'probe-ext')->first();
        $this->assertNotNull($created);
        $this->assertNotSame(4242, (int) $created->getKey());
        $this->assertSame(1, (int) $created->is_enabled);
    }

    /**
     * 基类更新同样不得接受 remember_token 覆盖。
     */
    public function test_fill_model_from_data_rejects_remember_token_on_update(): void
    {
        $extension = Extension::query()->create([
            'name'       => 'update-target',
            'is_enabled' => 1,
        ]);

        $service = new class extends AdminService {
            public function __construct()
            {
                parent::__construct();
                $this->modelName = Extension::class;
            }
        };

        $originalId = $extension->getKey();

        $this->assertTrue($service->update($originalId, [
            'name'       => 'update-target-renamed',
            'is_enabled' => 0,
            'id'         => 99999,
        ]));

        $extension->refresh();
        $this->assertSame('update-target-renamed', $extension->name);
        $this->assertSame(0, (int) $extension->is_enabled);
        $this->assertSame((int) $originalId, (int) $extension->getKey());
    }

    /**
     * 管理员用户创建路径应拒绝自选主键与 remember_token，密码与 enabled 仍可按业务写入。
     */
    public function test_admin_user_store_rejects_primary_key_and_remember_token(): void
    {
        $this->actingAsSuperAdmin();

        $service = new AdminUserService();

        $this->assertTrue($service->store([
            'username'         => 'mass_assign_probe',
            'name'             => 'Mass Assign Probe',
            'password'         => 'password',
            'confirm_password' => 'password',
            'enabled'          => 0,
            'id'               => 8888,
            'remember_token'   => 'forged_token',
            'roles'            => [1],
        ]));

        $created = AdminUser::query()->where('username', 'mass_assign_probe')->first();
        $this->assertNotNull($created);
        $this->assertNotSame(8888, (int) $created->getKey());
        $this->assertNull($created->remember_token);
        $this->assertSame(0, (int) $created->enabled);
        $this->assertTrue(Hash::check('password', $created->password));
    }

    /**
     * 管理员用户更新不得被客户端改写 remember_token。
     */
    public function test_admin_user_update_rejects_remember_token(): void
    {
        $this->actingAsSuperAdmin();

        $targetId = AdminUser::query()->insertGetId([
            'username'       => 'token_victim',
            'password'       => bcrypt('password'),
            'name'           => 'Victim',
            'enabled'        => 1,
            'remember_token' => 'legitimate-token',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        $service = new AdminUserService();

        $this->assertTrue($service->update($targetId, [
            'username'       => 'token_victim',
            'name'           => 'Victim Updated',
            'enabled'        => 1,
            'remember_token' => 'attacker-token',
            'roles'          => [1],
        ]));

        $user = AdminUser::query()->find($targetId);
        $this->assertSame('Victim Updated', $user->name);
        $this->assertSame('legitimate-token', $user->remember_token);
    }

    /**
     * 个人设置更新应能写入经 passwordHandler 哈希后的密码。
     */
    public function test_update_user_setting_persists_hashed_password(): void
    {
        $this->actingAsSuperAdmin();

        $service = new AdminUserService();

        $this->assertTrue($service->updateUserSetting(1, [
            'username'         => 'super',
            'name'             => 'Super Renamed',
            'password'         => 'new-secret',
            'confirm_password' => 'new-secret',
            'old_password'     => 'password',
        ]));

        $user = AdminUser::query()->find(1);
        $this->assertSame('Super Renamed', $user->name);
        $this->assertTrue(Hash::check('new-secret', $user->password));
        $this->assertFalse(Hash::check('password', $user->password));
    }

    /**
     * 个人设置更新仍应拒绝 remember_token 批量写入。
     */
    public function test_update_user_setting_rejects_remember_token(): void
    {
        $this->actingAsSuperAdmin();

        AdminUser::query()->whereKey(1)->update(['remember_token' => 'keep-me']);

        $service = new AdminUserService();

        $this->assertTrue($service->updateUserSetting(1, [
            'username'       => 'super',
            'name'           => 'Super',
            'remember_token' => 'profile-attacker-token',
        ]));

        $user = AdminUser::query()->find(1);
        $this->assertSame('keep-me', $user->remember_token);
    }
}
