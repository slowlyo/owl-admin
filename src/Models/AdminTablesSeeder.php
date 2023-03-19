<?php

namespace Slowlyo\OwlAdmin\Models;

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
                'icon'      => 'ph:chart-line-up-fill',
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
                'icon'      => 'mdi:information-outline',
                'url'       => '/system/settings',
                'is_home'   => 0,
            ],
        ]);

        settings()->set(
            'system_theme_setting',
            '"{\"darkMode\":false,\"followSystemTheme\":true,\"layout\":{\"minWidth\":900,\"mode\":\"vertical\",\"modeList\":[{\"value\":\"vertical\",\"label\":\"\u5de6\u4fa7\u83dc\u5355\u6a21\u5f0f\"},{\"value\":\"vertical-mix\",\"label\":\"\u5de6\u4fa7\u83dc\u5355\u6df7\u5408\u6a21\u5f0f\"},{\"value\":\"horizontal\",\"label\":\"\u9876\u90e8\u83dc\u5355\u6a21\u5f0f\"},{\"value\":\"horizontal-mix\",\"label\":\"\u9876\u90e8\u83dc\u5355\u6df7\u5408\u6a21\u5f0f\"}]},\"themeColor\":\"#1890ff\",\"themeColorList\":[\"#1890ff\",\"#409EFF\",\"#2d8cf0\",\"#007AFF\",\"#5ac8fa\",\"#5856D6\",\"#536dfe\",\"#9c27b0\",\"#AF52DE\",\"#0096c7\",\"#00C1D4\",\"#34C759\",\"#43a047\",\"#7cb342\",\"#c0ca33\",\"#78DEC7\",\"#e53935\",\"#d81b60\",\"#f4511e\",\"#fb8c00\",\"#ffb300\",\"#fdd835\",\"#6d4c41\",\"#546e7a\"],\"otherColor\":{\"info\":\"#096dd9\",\"success\":\"#52c41a\",\"warning\":\"#faad14\",\"error\":\"#f5222d\"},\"isCustomizeInfoColor\":false,\"fixedHeaderAndTab\":true,\"showReload\":true,\"header\":{\"inverted\":false,\"height\":56,\"crumb\":{\"visible\":true,\"showIcon\":true}},\"tab\":{\"visible\":true,\"height\":44,\"mode\":\"chrome\",\"modeList\":[{\"value\":\"chrome\",\"label\":\"\u8c37\u6b4c\u98ce\u683c\"},{\"value\":\"button\",\"label\":\"\u6309\u94ae\u98ce\u683c\"}],\"isCache\":true},\"sider\":{\"inverted\":false,\"width\":220,\"collapsedWidth\":64,\"mixWidth\":80,\"mixCollapsedWidth\":48,\"mixChildMenuWidth\":200},\"menu\":{\"horizontalPosition\":\"flex-start\",\"horizontalPositionList\":[{\"value\":\"flex-start\",\"label\":\"\u5c45\u5de6\"},{\"value\":\"center\",\"label\":\"\u5c45\u4e2d\"},{\"value\":\"flex-end\",\"label\":\"\u5c45\u53f3\"}]},\"footer\":{\"fixed\":false,\"height\":48,\"visible\":false},\"page\":{\"animate\":true,\"animateMode\":\"fade-slide\",\"animateModeList\":[{\"value\":\"fade-slide\",\"label\":\"\u6ed1\u52a8\"},{\"value\":\"fade\",\"label\":\"\u6d88\u9000\"},{\"value\":\"fade-bottom\",\"label\":\"\u5e95\u90e8\u6d88\u9000\"},{\"value\":\"fade-scale\",\"label\":\"\u7f29\u653e\u6d88\u9000\"},{\"value\":\"zoom-fade\",\"label\":\"\u6e10\u53d8\"},{\"value\":\"zoom-out\",\"label\":\"\u95ea\u73b0\"}]}}"'
        );
    }
}
