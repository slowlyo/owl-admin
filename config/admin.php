<?php

return [
    // 应用名称
    'name' => 'Slow Admin',

    // 应用 logo
    'logo' => 'vendor/admin/logo.png',

    'default_avatar' => 'vendor/admin/default-avatar.png',

    'debug' => true,

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
        'guard'      => 'admin',
        'guards'     => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],
        'providers'  => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => \Slowlyo\SlowAdmin\Models\AdminUser::class,
            ],
        ],
        'remember'   => true,
        'except'     => [
            'login',
            'logout',
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
        // 是否启用默认用户菜单
        'enable_user_menu' => true,
    ],

    'https' => false,

    'show_development_tools' => true,
];
