<?php

\Illuminate\Support\Facades\Route::group([
    'domain'     => config('admin.route.domain'),
    'prefix'     => config('admin.route.prefix'),
    'middleware' => config('admin.route.middleware'),
], function (\Illuminate\Routing\Router $router) {
    $router->get('/', [\Slowlyo\SlowAdmin\Controllers\IndexController::class, 'index']);
    $router->get('/login', [\Slowlyo\SlowAdmin\Controllers\AuthController::class, 'index']);
    $router->post('/login', [\Slowlyo\SlowAdmin\Controllers\AuthController::class, 'login']);
    $router->get('/logout', [\Slowlyo\SlowAdmin\Controllers\AuthController::class, 'logout']);

    $router->get('/base', [\Slowlyo\SlowAdmin\Controllers\IndexController::class, 'base']);
    $router->get('/no-content', [\Slowlyo\SlowAdmin\Controllers\IndexController::class, 'noContent']);

    // 用户设置
    $router->get('/user_setting', [\Slowlyo\SlowAdmin\Controllers\AuthController::class, 'userSetting']);
    $router->put('/user_setting/{id}', [\Slowlyo\SlowAdmin\Controllers\AuthController::class, 'saveUserSetting']);

    // 图片上传
    $router->any('upload_image', [\Slowlyo\SlowAdmin\Controllers\IndexController::class, 'uploadImage']);
    // 文件上传
    $router->any('upload_file', [\Slowlyo\SlowAdmin\Controllers\IndexController::class, 'uploadFile']);

    // 主页
    $router->resource('home', \Slowlyo\SlowAdmin\Controllers\HomeController::class);
    // 管理员
    $router->resource('admin_users', \Slowlyo\SlowAdmin\Controllers\AdminUserController::class);
    // 菜单
    $router->resource('admin_menus', \Slowlyo\SlowAdmin\Controllers\AdminMenuController::class);
    // 角色
    $router->resource('admin_roles', \Slowlyo\SlowAdmin\Controllers\AdminRoleController::class);
    // 权限
    $router->resource('admin_permissions', \Slowlyo\SlowAdmin\Controllers\AdminPermissionController::class);
});
