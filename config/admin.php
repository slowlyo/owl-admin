<?php

return [
    // 应用名称
    'name'           => env('ADMIN_APP_NAME', 'Owl Admin'),

    // 应用 logo
    'logo'           => env('ADMIN_LOGO', '/admin-assets/logo.png'),

    // 默认头像
    'default_avatar' => env('ADMIN_DEFAULT_AVATAR', '/admin-assets/default-avatar.png'),

    // 应用安装目录
    'directory'      => app_path('Admin'),

    // 引导文件
    'bootstrap'      => app_path('Admin/bootstrap.php'),

    // 应用路由
    'route'          => [
        'prefix'               => env('ADMIN_ROUTE_PREFIX', 'admin-api'),
        'domain'               => env('ADMIN_DOMAIN'),
        'namespace'            => 'App\\Admin\\Controllers',
        'middleware'           => ['admin'],
        // 不包含额外路由, 配置后, 不会追加新增/详情/编辑页面路由
        'without_extra_routes' => [
            '/dashboard',
        ],
    ],

    'auth' => [
        // 是否开启验证码
        'login_captcha'    => env('ADMIN_LOGIN_CAPTCHA', true),
        // 是否开启认证
        'enable'           => env('ADMIN_ENABLE_AUTH', true),
        // 是否开启鉴权
        'permission'       => env('ADMIN_ENABLE_PERMISSION', true),
        // token 有效期 (分钟), 为空则不会过期
        'token_expiration' => env('ADMIN_TOKEN_EXPIRATION'),
        'guard'            => 'admin',
        'guards'           => [
            'admin' => [
                'driver'   => 'sanctum',
                'provider' => 'admin',
            ],
        ],
        'providers'        => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => \Slowlyo\OwlAdmin\Models\AdminUser::class,
            ],
        ],
        'except'           => [

        ],
    ],

    'upload' => [
        'disk'      => env('ADMIN_UPLOAD_DISK', 'public'),
        // 文件上传目录
        'directory' => [
            'image' => env('ADMIN_UPLOAD_IMAGE_DIRECTORY', 'images'),
            'file'  => env('ADMIN_UPLOAD_FILE_DIRECTORY', 'files'),
            'rich'  => env('ADMIN_UPLOAD_RICH_DIRECTORY', 'rich'),
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
        'title'              => env('ADMIN_SITE_TITLE', '%title% | OwlAdmin'),
        'header'             => [
            // 是否显示 [刷新] 按钮
            'refresh'       => env('ADMIN_HEADER_REFRESH', true),
            // 是否显示 [暗色模式] 按钮
            'dark'          => env('ADMIN_HEADER_DARK', true),
            // 是否显示 [全屏] 按钮
            'full_screen'   => env('ADMIN_HEADER_FULL_SCREEN', true),
            // 是否显示 [多语言] 按钮
            'locale_toggle' => env('ADMIN_HEADER_LOCALE_TOGGLE', true),
            // 是否显示 [主题配置] 按钮
            'theme_config'  => env('ADMIN_HEADER_THEME_CONFIG', true),
        ],
        // 多语言选项
        'locale_options'     => [
            'en'    => 'English',
            'zh_CN' => '简体中文',
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

    'database' => [
        'connection' => env('ADMIN_DB_CONNECTION') ?? env('DB_CONNECTION', 'mysql'),
    ],

    'models' => [
        'admin_user'       => \Slowlyo\OwlAdmin\Models\AdminUser::class,
        'admin_role'       => \Slowlyo\OwlAdmin\Models\AdminRole::class,
        'admin_menu'       => \Slowlyo\OwlAdmin\Models\AdminMenu::class,
        'admin_permission' => \Slowlyo\OwlAdmin\Models\AdminPermission::class,
    ],

    'modules_namespace' => 'AdminModules',

    'modules_dir' => base_path('admin-modules'),

    'modules' => [
    ],
];
