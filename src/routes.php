<?php

use Slowlyo\SlowAdmin\Controllers;

\Illuminate\Support\Facades\Route::group([
    'domain'     => config('admin.route.domain'),
    'prefix'     => config('admin.route.prefix'),
    'middleware' => config('admin.route.middleware'),
], function (\Illuminate\Routing\Router $router) {
    $router->get('/', [Controllers\IndexController::class, 'index']);
    $router->get('/login', [Controllers\AuthController::class, 'index']);
    $router->post('/login', [Controllers\AuthController::class, 'login']);
    $router->get('/logout', [Controllers\AuthController::class, 'logout']);
    $router->get('/login/reload-captcha', [Controllers\AuthController::class, 'reloadCaptcha']);
    $router->get('/current-user', [Controllers\AuthController::class, 'currentUser']);

    $router->get('/base', [Controllers\IndexController::class, 'base']);
    $router->get('/no-content', [Controllers\IndexController::class, 'noContent']);
    $router->get('/menus', [Controllers\IndexController::class, 'menus']);

    // 用户设置
    $router->get('/user_setting', [Controllers\AuthController::class, 'userSetting']);
    $router->put('/user_setting/{id}', [Controllers\AuthController::class, 'saveUserSetting']);

    // 图片上传
    $router->any('upload_image', [Controllers\IndexController::class, 'uploadImage']);
    // 文件上传
    $router->any('upload_file', [Controllers\IndexController::class, 'uploadFile']);

    // 主页
    $router->resource('dashboard', Controllers\HomeController::class);
    // 管理员
    $router->resource('admin_users', Controllers\AdminUserController::class);
    // 菜单
    $router->resource('admin_menus', Controllers\AdminMenuController::class);
    // 快速编辑
    $router->post('admin_menu_quick_save', [Controllers\AdminMenuController::class, 'quickEdit']);
    // 角色
    $router->resource('admin_roles', Controllers\AdminRoleController::class);
    // 权限
    $router->resource('admin_permissions', Controllers\AdminPermissionController::class);

    $router->post('_admin_permissions_auto_generate', [Controllers\AdminPermissionController::class, 'autoGenerate']);

    // 开发工具
    $router->group(['prefix' => 'dev_tools'], function (\Illuminate\Routing\Router $router) {
        // 代码生成器
        $router->resource('code_generator', Controllers\DevTools\CodeGeneratorController::class);
    });
});
