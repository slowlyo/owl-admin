<?php

return [
    // 应用名称
    'name'           => 'Slow Admin',

    // 应用 logo
    'logo'           => '/admin/logo.png',

    // 默认头像
    'default_avatar' => '/admin/default-avatar.png',

    // 底部信息
    'footer'         => '© 2023 <a href="https://gitee.com/slowlyo/slow-admin" target="_blank">Slow Admin</a>',

    'directory' => app_path('Admin'),

    'bootstrap' => app_path('Admin/bootstrap.php'),

    'route' => [
        'prefix'     => 'admin-api',
        'domain'     => null,
        'namespace'  => 'App\\Admin\\Controllers',
        'middleware' => ['admin'],
    ],

    'auth' => [
        // 是否开启验证码
        'login_captcha' => true,
        // 是否开启鉴权
        'enable'        => true,
        // 用户模型
        'model'         => \Slowlyo\SlowAdmin\Models\AdminUser::class,
        'controller'    => \Slowlyo\SlowAdmin\Controllers\AuthController::class,
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

    'https'                                => false,

    // 是否显示 [开发者工具]
    'show_development_tools'               => true,

    // 是否显示 [权限] 功能中的自动生成按钮
    'show_auto_generate_permission_button' => true,

    // 扩展
    'extension'                            => [
        'dir' => base_path('extensions'),
    ],
];
