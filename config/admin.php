<?php

return [
    // 应用名称
    'name'           => 'Slow Admin',

    // 应用 logo
    'logo'           => 'vendor/admin/logo.png',

    // 默认头像
    'default_avatar' => 'vendor/admin/default-avatar.png',

    // amis debug
    'debug'          => true,

    'directory' => app_path('Admin'),

    'bootstrap' => app_path('Admin/bootstrap.php'),

    'route' => [
        'prefix'     => 'admin',
        'domain'     => null,
        'namespace'  => 'App\\Admin\\Controllers',
        'middleware' => ['web', 'admin'],
    ],

    'auth' => [
        'enable'     => true,
        'controller' => \Slowlyo\SlowAdmin\Controllers\AuthController::class,
        'guard'      => 'sanctum',
        'remember'   => true,
        'captcha'    => false,
        'except'     => [
            'login',
            'logout',
            'no-content'
        ],
    ],

    'upload' => [
        'disk'      => 'public',
        // Image and file upload path under the disk above.
        'directory' => [
            'image' => 'images',
            'file'  => 'files',
        ],
    ],

    // 布局相关
    'layout' => [
        // amis主题  default/ang/antd/dark
        'theme'            => 'default',
        // 是否启用默认用户菜单
        'enable_user_menu' => true,
    ],

    'https' => false,

    'show_development_tools'               => true,

    // 是否显示 [权限] 功能中的自动生成按钮
    'show_auto_generate_permission_button' => true,
];
