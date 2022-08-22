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
            'name'     => '超级管理员',
        ]);

        AdminRole::truncate();
        AdminRole::create([
            'name' => '超级管理员',
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
        ])->each(fn($item) => AdminPermission::create($item));

        AdminRole::first()->permissions()->save(AdminPermission::first());

        AdminMenu::truncate();
        AdminMenu::insert([
            [
                'parent_id' => 0,
                'title'     => '首页',
                'icon'      => 'fa-solid fa-chart-line',
                'url'       => '/dashboard',
                'api'       => '/home',
            ],
            [
                'parent_id' => 0,
                'title'     => '系统管理',
                'icon'      => 'fa-solid fa-screwdriver-wrench',
                'url'       => '',
                'api'       => '',
            ],
            [
                'parent_id' => 2,
                'title'     => '管理员',
                'icon'      => 'fa-solid fa-user',
                'url'       => '/admin_users',
                'api'       => '/admin_users',
            ],
            [
                'parent_id' => 2,
                'title'     => '角色',
                'icon'      => 'fa-solid fa-circle-notch',
                'url'       => '/admin_roles',
                'api'       => '/admin_roles',
            ],
            [
                'parent_id' => 2,
                'title'     => '权限',
                'icon'      => 'fa-solid fa-user-shield',
                'url'       => '/admin_permissions',
                'api'       => '/admin_permissions',
            ],
            [
                'parent_id' => 2,
                'title'     => '菜单',
                'icon'      => 'fa-solid fa-bars',
                'url'       => '/admin_menus',
                'api'       => '/admin_menus',
            ],
        ]);
    }
}
