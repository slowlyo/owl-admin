<?php

return [
    // 应用名称
    'name'           => 'Owl Admin',

    // 应用 logo
    'logo'           => '/admin/logo.png',

    // 默认头像
    'default_avatar' => '/admin/default-avatar.png',

    'directory' => app_path('Admin'),

    'bootstrap' => app_path('Admin/bootstrap.php'),

    'route' => [
        'prefix'               => 'admin-api',
        'domain'               => null,
        'namespace'            => 'App\\Admin\\Controllers',
        'middleware'           => ['admin'],
        // 不包含额外路由, 配置后, 不会追加新增/详情/编辑页面路由
        'without_extra_routes' => [
            '/dashboard',
        ],
    ],

    'auth' => [
        // 是否开启验证码
        'login_captcha' => env('ADMIN_LOGIN_CAPTCHA', true),
        // 是否开启鉴权
        'enable'        => true,
        // 用户模型
        'model'         => \Slowlyo\OwlAdmin\Models\AdminUser::class,
        'controller'    => \Slowlyo\OwlAdmin\Controllers\AuthController::class,
        'guard'         => 'sanctum',
        'except'        => [

        ],
    ],

    'upload' => [
        'disk'      => 'public',
        // 文件上传目录
        'directory' => [
            'image' => 'images',
            'file'  => 'files',
            'rich'  => 'rich',
        ],
    ],

    'https'                                => env('ADMIN_HTTPS', false),

    // 是否显示 [开发者工具]
    'show_development_tools'               => env('ADMIN_SHOW_DEVELOPMENT_TOOLS', true),

    // 是否显示 [权限] 功能中的自动生成按钮
    'show_auto_generate_permission_button' => env('ADMIN_SHOW_AUTO_GENERATE_PERMISSION_BUTTON', true),

    // 扩展
    'extension'                            => [
        'dir' => base_path('extensions'),
    ],

    'layout' => [
        // 浏览器标题, 功能名称使用 %title% 代替
        'title'              => '%title% | OwlAdmin',
        'header'             => [
            // 是否显示 [刷新] 按钮
            'refresh'      => true,
            // 是否显示 [全屏] 按钮
            'full_screen'  => true,
            // 是否显示 [主题配置] 按钮
            'theme_config' => true,
        ],
        /*
         * keep_alive 页面缓存黑名单
         *
         * eg:
         * 列表: /user
         * 详情: /user/:id
         * 编辑: /user/:id/edit
         * 新增: /user/create
         */
        'keep_alive_exclude' => [],
        // 底部信息
        'footer'             => '<a href="https://github.com/slowlyo/owl-admin" target="_blank">Owl Admin</a>',
    ],

    'models' => [
        'admin_user'       => \Slowlyo\OwlAdmin\Models\AdminUser::class,
        'admin_role'       => \Slowlyo\OwlAdmin\Models\AdminRole::class,
        'admin_menu'       => \Slowlyo\OwlAdmin\Models\AdminMenu::class,
        'admin_permission' => \Slowlyo\OwlAdmin\Models\AdminPermission::class,
    ],

    'modules' => [
    ],
];
