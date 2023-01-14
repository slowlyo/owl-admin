<?php

namespace Slowlyo\SlowAdmin\Models;

use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    public function run()
    {
        AdminUser::truncate();
        AdminUser::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name'     => 'Administrator',
        ]);

        AdminRole::truncate();
        AdminRole::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        AdminUser::first()->roles()->save(AdminRole::first());

        AdminPermission::truncate();
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
        ])->each(fn($item) => AdminPermission::create($item));

        AdminRole::first()->permissions()->save(AdminPermission::first());

        AdminMenu::truncate();
        AdminMenu::insert([
            [
                'parent_id' => 0,
                'title'     => 'dashboard',
                'icon'      => 'fa-solid fa-chart-line',
                'url'       => '/dashboard',
            ],
            [
                'parent_id' => 0,
                'title'     => 'admin_system',
                'icon'      => 'fa-solid fa-screwdriver-wrench',
                'url'       => '/system',
            ],
            [
                'parent_id' => 2,
                'title'     => 'admin_users',
                'icon'      => 'fa-solid fa-user',
                'url'       => '/system/admin_users',
            ],
            [
                'parent_id' => 2,
                'title'     => 'admin_roles',
                'icon'      => 'fa-solid fa-circle-notch',
                'url'       => '/system/admin_roles',
            ],
            [
                'parent_id' => 2,
                'title'     => 'admin_permission',
                'icon'      => 'fa-solid fa-user-shield',
                'url'       => '/system/admin_permissions',
            ],
            [
                'parent_id' => 2,
                'title'     => 'admin_menu',
                'icon'      => 'fa-solid fa-bars',
                'url'       => '/system/admin_menus',
            ],
            [
                'parent_id' => 2,
                'title'     => 'admin_setting',
                'icon'      => 'fa-solid fa-gears',
                'url'       => '/system/settings',
            ],
        ]);
    }
}
