<?php

use Slowlyo\OwlAdmin\Controllers;

\Illuminate\Support\Facades\Route::group([
    'domain'     => config('admin.route.domain'),
    'prefix'     => config('admin.route.prefix'),
    'middleware' => config('admin.route.middleware'),
], function (\Illuminate\Routing\Router $router) {
    $router->get('/login', [Controllers\AuthController::class, 'loginPage']);
    $router->post('/login', [Controllers\AuthController::class, 'login']);
    $router->get('/logout', [Controllers\AuthController::class, 'logout']);
    $router->get('/current-user', [Controllers\AuthController::class, 'currentUser']);
    $router->get('/captcha', [Controllers\AuthController::class, 'reloadCaptcha']);

    $router->get('/no-content', [Controllers\IndexController::class, 'noContentResponse']);
    $router->get('/menus', [Controllers\IndexController::class, 'menus']);
    $router->get('/_settings', [Controllers\IndexController::class, 'settings']);
    $router->post('/_settings', [Controllers\IndexController::class, 'saveSettings']);
    $router->get('_download_export', [Controllers\IndexController::class, 'downloadExport']);

    // 用户设置
    $router->get('/user_setting', [Controllers\AuthController::class, 'userSetting']);
    $router->put('/user_setting', [Controllers\AuthController::class, 'saveUserSetting']);

    // 图片上传
    $router->any('upload_image', [Controllers\IndexController::class, 'uploadImage']);
    // 文件上传
    $router->any('upload_file', [Controllers\IndexController::class, 'uploadFile']);
    // 富文本编辑器上传
    $router->any('upload_rich', [Controllers\IndexController::class, 'uploadRich']);

    // 主页
    $router->resource('dashboard', Controllers\HomeController::class);

    $router->group(['prefix' => 'system'], function (\Illuminate\Routing\Router $router) {
        $router->get('/', [Controllers\AdminUserController::class, 'index']);
        // 管理员
        $router->resource('admin_users', Controllers\AdminUserController::class);
        // 菜单
        $router->resource('admin_menus', Controllers\AdminMenuController::class);
        // 快速编辑
        $router->post('admin_menu_quick_save', [Controllers\AdminMenuController::class, 'quickEdit']);
        // 角色保存权限
        $router->post('admin_role_save_permissions', [Controllers\AdminRoleController::class, 'savePermissions']);
        // 角色
        $router->resource('admin_roles', Controllers\AdminRoleController::class);
        // 权限
        $router->resource('admin_permissions', Controllers\AdminPermissionController::class);

        $router->post('_admin_permissions_auto_generate', [
            Controllers\AdminPermissionController::class,
            'autoGenerate',
        ]);
    });

    // 开发工具
    $router->group(['prefix' => 'dev_tools'], function (\Illuminate\Routing\Router $router) {
        $router->get('/', [Controllers\DevTools\CodeGeneratorController::class, 'index']);
        // 代码生成器
        $router->resource('code_generator', Controllers\DevTools\CodeGeneratorController::class);

        // 扩展
        $router->resource('extensions', Controllers\DevTools\ExtensionController::class);
        // 本地扩展安装
        $router->post('extensions/install', [Controllers\DevTools\ExtensionController::class, 'install']);
        // 启用/禁用扩展
        $router->post('extensions/enable', [Controllers\DevTools\ExtensionController::class, 'enable']);
        // 卸载扩展
        $router->post('extensions/uninstall', [Controllers\DevTools\ExtensionController::class, 'uninstall']);
        // 获取扩展配置
        $router->post('extensions/get_config', [Controllers\DevTools\ExtensionController::class, 'getConfig']);
        // 保存扩展配置
        $router->post('extensions/save_config', [Controllers\DevTools\ExtensionController::class, 'saveConfig']);
        // 获取扩展配置表单
        $router->post('extensions/config_form', [Controllers\DevTools\ExtensionController::class, 'configForm']);

        // 终端
        $router->get('terminal', [Controllers\DevTools\TerminalController::class, 'index']);
        // artisan 信息查询
        $router->post('terminal/artisan_schema', [Controllers\DevTools\TerminalController::class, 'artisanSchema']);
        // composer options
        $router->get('terminal/composer_options', [Controllers\DevTools\TerminalController::class, 'composerOptions']);
        // 预加载
        $router->post('terminal/preload', [Controllers\DevTools\TerminalController::class, 'preload']);
        // 终端执行命令
        $router->post('terminal/exec', [Controllers\DevTools\TerminalController::class, 'exec']);
    });
});
