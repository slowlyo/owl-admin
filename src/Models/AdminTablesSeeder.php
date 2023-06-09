<?php

namespace Slowlyo\OwlAdmin\Models;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    public function run()
    {
        Admin::adminUserModel()::unguard();
        Admin::adminMenuModel()::unguard();
        Admin::adminPermissionModel()::unguard();
        Admin::adminRoleModel()::unguard();

        Admin::adminUserModel()::query()->truncate();
        Admin::adminUserModel()::query()->create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name'     => 'Administrator',
        ]);

        Admin::adminRoleModel()::query()->truncate();
        Admin::adminRoleModel()::query()->create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        Admin::adminUserModel()::query()->first()->roles()->save(Admin::adminRoleModel()::query()->first());

        Admin::adminPermissionModel()::query()->truncate();
        collect([
            [
                'name'      => '首页',
                'slug'      => 'home',
                'http_path' => ['/home*'],
                "parent_id" => 0,
            ],
            [
                'name'      => '系统',
                'slug'      => 'system',
                'http_path' => '',
                "parent_id" => 0,
            ],
            [
                'name'      => '管理员',
                'slug'      => 'admin_users',
                'http_path' => ["/admin_users*"],
                "parent_id" => 2,
            ],
            [
                'name'      => '角色',
                'slug'      => 'roles',
                'http_path' => ["/roles*"],
                "parent_id" => 2,
            ],
            [
                'name'      => '权限',
                'slug'      => 'permissions',
                'http_path' => ["/permissions*"],
                "parent_id" => 2,
            ],
            [
                'name'      => '菜单',
                'slug'      => 'menus',
                'http_path' => ["/menus*"],
                "parent_id" => 2,
            ],
            [
                'name'      => '设置',
                'slug'      => 'settings',
                'http_path' => ["/settings*"],
                "parent_id" => 2,
            ],
        ])->each(fn($item) => Admin::adminPermissionModel()::query()->create($item));

        Admin::adminRoleModel()::query()->first()->permissions()->save(Admin::adminPermissionModel()::query()->first());

        Admin::adminMenuModel()::query()->truncate();
        Admin::adminMenuModel()::query()->insert([
            [
                'parent_id' => 0,
                'title'     => 'dashboard',
                'icon'      => 'mdi:chart-line',
                'url'       => '/dashboard',
                'is_home'   => 1,
            ],
            [
                'parent_id' => 0,
                'title'     => 'admin_system',
                'icon'      => 'material-symbols:settings-outline',
                'url'       => '/system',
                'is_home'   => 0,
            ],
            [
                'parent_id' => 2,
                'title'     => 'admin_users',
                'icon'      => 'ph:user-gear',
                'url'       => '/system/admin_users',
                'is_home'   => 0,
            ],
            [
                'parent_id' => 2,
                'title'     => 'admin_roles',
                'icon'      => 'carbon:user-role',
                'url'       => '/system/admin_roles',
                'is_home'   => 0,
            ],
            [
                'parent_id' => 2,
                'title'     => 'admin_permission',
                'icon'      => 'fluent-mdl2:permissions',
                'url'       => '/system/admin_permissions',
                'is_home'   => 0,
            ],
            [
                'parent_id' => 2,
                'title'     => 'admin_menu',
                'icon'      => 'ant-design:menu-unfold-outlined',
                'url'       => '/system/admin_menus',
                'is_home'   => 0,
            ],
            [
                'parent_id' => 2,
                'title'     => 'admin_setting',
                'icon'      => 'akar-icons:settings-horizontal',
                'url'       => '/system/settings',
                'is_home'   => 0,
            ],
        ]);
    }
}
