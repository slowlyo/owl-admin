<?php

namespace Slowlyo\OwlAdmin;

use Illuminate\Support\Facades\Auth;
use Slowlyo\OwlAdmin\Extend\Manager;
use Slowlyo\OwlAdmin\Traits\AssetsTrait;
use Slowlyo\OwlAdmin\Extend\ServiceProvider;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Slowlyo\OwlAdmin\Services\AdminSettingService;
use Slowlyo\OwlAdmin\Models\{AdminMenu, AdminRole, AdminUser, AdminPermission};
use Slowlyo\OwlAdmin\Support\{Context, Composer, Cores\Module, Cores\Route, Cores\Permission, Cores\JsonResponse};

class Admin
{
    use AssetsTrait;

    public static function make(): static
    {
        return new static();
    }

    public static function response()
    {
        return new JsonResponse();
    }

    /**
     * @return \Slowlyo\OwlAdmin\Support\Cores\Menu;
     */
    public static function menu()
    {
        return app('admin.menu');
    }

    /**
     * @return Permission
     */
    public static function permission()
    {
        return new Permission;
    }

    public static function guard()
    {
        return Auth::guard(self::config('admin.auth.guard') ?: 'admin');
    }

    /**
     * @return \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public static function user()
    {
        return static::guard()->user();
    }

    public static function bootstrap()
    {
        $file = self::config('admin.bootstrap');

        if (is_file($file)) {
            require self::config('admin.bootstrap');
        }
    }

    /**
     * 加载框架路由
     *
     * @return void
     */
    public static function loadBaseRoute()
    {
        Route::baseLoad();
    }

    /**
     * @param string|null $name
     *
     * @return Manager|ServiceProvider|null
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function extension(?string $name = '')
    {
        if ($name) {
            return app('admin.extend')->get($name);
        }

        return app('admin.extend');
    }

    public static function classLoader()
    {
        return Composer::loader();
    }

    /**
     * 上下文管理.
     *
     * @return Context
     */
    public static function context()
    {
        return app('admin.context');
    }

    /**
     * @return AdminSettingService
     */
    public static function setting()
    {
        return app('admin.setting');
    }

    /**
     * 往分组插入中间件.
     *
     * @param array $mix
     */
    public static function mixMiddlewareGroup(array $mix = [])
    {
        $router = app('router');
        $group  = $router->getMiddlewareGroups()['admin'] ?? [];

        if ($mix) {
            $finalGroup = [];

            foreach ($group as $i => $mid) {
                $next = $i + 1;

                $finalGroup[] = $mid;

                if (!isset($group[$next]) || $group[$next] !== 'admin.permission') {
                    continue;
                }

                $finalGroup = array_merge($finalGroup, $mix);

                $mix = [];
            }

            if ($mix) {
                $finalGroup = array_merge($finalGroup, $mix);
            }

            $group = $finalGroup;
        }

        $router->middlewareGroup('admin', $group);
    }

    /**
     * @return AdminMenu
     */
    public static function adminMenuModel()
    {
        return self::config('admin.models.admin_menu', AdminMenu::class);
    }

    /**
     * @return AdminPermission
     */
    public static function adminPermissionModel()
    {
        return self::config('admin.models.admin_permission', AdminPermission::class);
    }

    /**
     * @return AdminRole
     */
    public static function adminRoleModel()
    {
        return self::config('admin.models.admin_role', AdminRole::class);
    }

    /**
     * @return AdminUser
     */
    public static function adminUserModel()
    {
        return self::config('admin.models.admin_user', AdminUser::class);
    }

    /**
     * @return Module
     */
    public static function module()
    {
        return app('admin.module');
    }

    /**
     * 当前模块
     *
     * @param bool $lower
     *
     * @return mixed|string|null
     */
    public static function currentModule(bool $lower = false)
    {
        $prefix = data_get(explode('/', request()->path()), 0);
        if ($prefix) {
            $m       = app(Module::class);
            $modules = $m->allModules(true);
            if (count($modules)) {
                $_list = collect($modules)
                    ->combine($modules)
                    ->map(fn($item) => config($m->getLowerName($item) . '.admin.route.prefix', ''))
                    ->flip()
                    ->toArray();

                if (key_exists($prefix, $_list)) {
                    return $lower ? $m->getLowerName($_list[$prefix]) : $_list[$prefix];
                }
            }
        }

        return null;
    }

    public static function config($key, $default = '')
    {
        if ($module = self::currentModule(true)) {
            return config($module . '.' . $key, $default);
        }

        return config($key, $default);
    }

    public static function view($apiPrefix = '')
    {
        if (!$apiPrefix) {
            $apiPrefix = self::config('admin.route.prefix');
        }

        if (is_file(public_path('admin-assets/index.html'))) {
            $view = file_get_contents(public_path('admin-assets/index.html'));
        } else {
            $view = file_get_contents(base_path('vendor/slowlyo/owl-admin/admin-views/dist/index.html'));
        }

        $script = '<script>window.$adminApiPrefix = "/' . $apiPrefix . '"</script>';

        return preg_replace('/<script>window.*?<\/script>/is', $script, $view);
    }
}
