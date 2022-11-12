<?php

return [
    // 应用名称
    'name'           => 'Slow Admin',

    // 应用 logo
    'logo'           => '/logo.png',

    // 默认头像
    'default_avatar' => '/default-avatar.png',

    // amis debug
    'debug'          => true,

    'directory' => app_path('Admin'),

    'bootstrap' => app_path('Admin/bootstrap.php'),

    'route' => [
        'prefix'     => 'admin-api',
        'domain'     => null,
        'namespace'  => 'App\\Admin\\Controllers',
        'middleware' => ['admin'],
    ],

    'auth' => [
        'enable'     => true,
        'controller' => \Slowlyo\SlowAdmin\Controllers\AuthController::class,
        'guard'      => 'sanctum',
        'except'     => [
            'login',
            'logout',
            'no-content',
            '_settings'
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

    'https' => false,

    'show_development_tools'               => true,

    // 是否显示 [权限] 功能中的自动生成按钮
    'show_auto_generate_permission_button' => true,
];
