<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Routing\Router;
use Slowlyo\OwlAdmin\Controllers\{AuthController,
    DevTools\PagesController,
    DevTools\RelationshipController,
    HomeController,
    IndexController,
    AdminUserController,
    AdminMenuController,
    AdminRoleController,
    AdminPermissionController,
    DevTools\EditorController,
    DevTools\ExtensionController,
    DevTools\CodeGeneratorController
};

class Route
{
    public static function baseLoad()
    {
        $modules = Admin::module()->allModules(true);

        array_unshift($modules, '');

        array_map(fn($item) => self::baseRoutes($item ? Admin::module()->getLowerName($item) . '.' : $item), $modules);
    }

    private static function baseRoutes($prefix)
    {
        $config = fn($key) => config($prefix . $key);

        app('router')->get('/admin', fn() => Admin::view());

        app('router')->group([
            'domain'     => $config('admin.route.domain'),
            'prefix'     => $config('admin.route.prefix'),
            'middleware' => $config('admin.route.middleware'),
            'as'         => $prefix,
        ], function (Router $router) use ($config) {
            $router->get('login', [AuthController::class, 'loginPage']);
            $router->post('login', [AuthController::class, 'login']);
            $router->get('logout', [AuthController::class, 'logout']);
            $router->get('captcha', [AuthController::class, 'reloadCaptcha']);
            $router->get('current-user', [AuthController::class, 'currentUser']);

            $router->get('menus', [IndexController::class, 'menus']);
            $router->get('_settings', [IndexController::class, 'settings']);
            $router->post('_settings', [IndexController::class, 'saveSettings']);
            $router->get('no-content', [IndexController::class, 'noContentResponse']);
            $router->get('_download_export', [IndexController::class, 'downloadExport']);
            $router->get('_iconify_search', [IndexController::class, 'iconifySearch']);

            $router->any('upload_file', [IndexController::class, 'uploadFile']);
            $router->any('upload_rich', [IndexController::class, 'uploadRich']);
            $router->any('upload_image', [IndexController::class, 'uploadImage']);
            $router->get('user_setting', [AuthController::class, 'userSetting']);
            $router->put('user_setting', [AuthController::class, 'saveUserSetting']);

            $router->resource('dashboard', HomeController::class);

            $router->group(['prefix' => 'system'], function (Router $router) {
                $router->get('/', [AdminUserController::class, 'index']);

                $router->resource('admin_users', AdminUserController::class);
                $router->post('admin_menus/save_order', [AdminMenuController::class, 'saveOrder']);
                $router->resource('admin_menus', AdminMenuController::class);
                $router->resource('admin_roles', AdminRoleController::class);
                $router->resource('admin_permissions', AdminPermissionController::class);

                $router->post('admin_role_save_permissions', [AdminRoleController::class, 'savePermissions']);
                $router->post('_admin_permissions_auto_generate', [AdminPermissionController::class, 'autoGenerate']);
            });

            if ($config('admin.show_development_tools')) {
                $router->group(['prefix' => 'dev_tools'], function (Router $router) {
                    $router->resource('code_generator', CodeGeneratorController::class);
                    $router->group(['prefix' => 'code_generator'], function (Router $router) {
                        $router->post('preview', [CodeGeneratorController::class, 'preview']);
                        $router->post('generate', [CodeGeneratorController::class, 'generate']);
                        $router->post('get_record', [CodeGeneratorController::class, 'getRecord']);
                        $router->post('get_property_options', [CodeGeneratorController::class, 'getPropertyOptions']);

                        $router->group(['prefix' => 'component_property'], function (Router $router) {
                            $router->post('/', [CodeGeneratorController::class, 'saveComponentProperty']);
                            $router->post('/list', [CodeGeneratorController::class, 'getComponentProperty']);
                            $router->post('/del', [CodeGeneratorController::class, 'delComponentProperty']);
                        });
                    });

                    $router->resource('extensions', ExtensionController::class);
                    $router->group(['prefix' => 'extensions'], function (Router $router) {
                        $router->post('enable', [ExtensionController::class, 'enable']);
                        $router->post('install', [ExtensionController::class, 'install']);
                        $router->post('uninstall', [ExtensionController::class, 'uninstall']);
                        $router->post('get_config', [ExtensionController::class, 'getConfig']);
                        $router->post('save_config', [ExtensionController::class, 'saveConfig']);
                        $router->post('config_form', [ExtensionController::class, 'configForm']);
                    });

                    $router->post('editor_parse', [EditorController::class, 'index']);

                    $router->resource('pages', PagesController::class);

                    $router->resource('relationships', RelationshipController::class);
                    $router->group(['prefix' => 'relation'], function (Router $router) {
                        $router->get('model_options', [RelationshipController::class, 'modelOptions']);
                    });
                });
            }
        });
    }
}
