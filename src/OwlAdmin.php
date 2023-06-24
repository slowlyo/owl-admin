<?php

namespace Slowlyo\OwlAdmin;

use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Slowlyo\OwlAdmin\Extend\Manager;
use Slowlyo\OwlAdmin\Extend\ServiceProvider;
use Slowlyo\OwlAdmin\Models\AdminMenu;
use Slowlyo\OwlAdmin\Models\AdminPermission;
use Slowlyo\OwlAdmin\Models\AdminRole;
use Slowlyo\OwlAdmin\Models\AdminUser;
use Slowlyo\OwlAdmin\Services\AdminSettingService;
use Slowlyo\OwlAdmin\Support\Composer;
use Slowlyo\OwlAdmin\Support\Context;
use Slowlyo\OwlAdmin\Support\JsonResponse;
use Slowlyo\OwlAdmin\Traits\Assets;

class OwlAdmin
{
    use Assets;

    public static function make(): static
    {
        return new static();
    }

    public static function response()
    {
        return new JsonResponse();
    }

    /**
     * @return \Slowlyo\OwlAdmin\Support\Menu;
     */
    public static function menu()
    {
        return app('admin.menu');
    }

    public static function guard()
    {
        return Auth::guard(config('admin.auth.guard') ?: 'admin');
    }

    public static function user()
    {
        return static::guard()->user();
    }

    public static function bootstrap()
    {
        $file = config('admin.bootstrap');

        if (is_file($file)) {
            require config('admin.bootstrap');
        }
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
        $group = $router->getMiddlewareGroups()['admin'] ?? [];

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
        return config('admin.models.admin_menu', AdminMenu::class);
    }

    /**
     * @return AdminPermission
     */
    public static function adminPermissionModel()
    {
        return config('admin.models.admin_permission', AdminPermission::class);
    }

    /**
     * @return AdminRole
     */
    public static function adminRoleModel()
    {
        return config('admin.models.admin_role', AdminRole::class);
    }

    /**
     * @return AdminUser
     */
    public static function adminUserModel()
    {
        return config('admin.models.admin_user', AdminUser::class);
    }
}
