<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use InvalidArgumentException;

class Permission
{
    public array $authExcept = [
        'login',
        'logout',
        'no-content',
        '_settings',
        'captcha',
        '_download_export',
    ];

    public array $permissionExcept = [
        'menus',
        'current-user',
        'user_setting',
        'login',
        'logout',
        'no-content',
        '_settings',
        'upload_image',
        'upload_file',
        'upload_rich',
        'captcha',
        '_download_export',
    ];

    /**
     * 身份验证拦截
     *
     * @param $request
     *
     * @return bool
     */
    public function authIntercept($request)
    {
        if (!Admin::config('admin.auth.enable')) {
            return false;
        }

        $excepted = collect(Admin::config('admin.auth.except', []))
            ->merge($this->authExcept)
            ->map(fn($path) => $this->pathFormatting($path))
            ->contains(fn($except) => $request->is($except == '/' ? $except : trim($except, '/')));

        return !$excepted && Admin::guard()->guest();
    }

    /**
     * 检查用户状态
     *
     * @return void
     */
    public function checkUserStatus()
    {
        $user = Admin::user();

        if ($user && !$user->enabled) {
            Admin::user()->currentAccessToken()->delete();
        }
    }

    /**
     * 权限拦截
     *
     * @param $request
     * @param $args
     *
     * @return bool
     */
    public function permissionIntercept($request, $args)
    {
        if (Admin::config('admin.auth.permission') === false) {
            return false;
        }

        if ($request->path() == Admin::config('admin.route.prefix')) {
            return false;
        }

        $excepted = collect(Admin::config('admin.auth.except', []))
            ->merge($this->permissionExcept)
            ->merge(Admin::config('admin.show_development_tools') ? ['/dev_tools*'] : [])
            ->map(fn($path) => $this->pathFormatting($path))
            ->contains(fn($except) => $request->is($except == '/' ? $except : trim($except, '/')));

        if ($excepted) {
            return false;
        }

        $user = Admin::user();

        if (!empty($args) || $this->checkRoutePermission($request) || $user?->isAdministrator()) {
            return false;
        }

        return !$user?->allPermissions()->first(fn($permission) => $permission->shouldPassThrough($request));
    }

    protected function checkRoutePermission(Request $request): bool
    {
        $middlewarePrefix = 'admin.permission:';

        $middleware = collect($request->route()
            ?->middleware())->first(fn($middleware) => Str::startsWith($middleware, $middlewarePrefix));

        if (!$middleware) {
            return false;
        }

        $args = explode(',', str_replace($middlewarePrefix, '', $middleware));

        $method = array_shift($args);

        if (!method_exists(Admin::adminPermissionModel(), $method)) {
            throw new InvalidArgumentException("Invalid permission method [$method].");
        }

        call_user_func([Admin::adminPermissionModel(), $method], $args);

        return true;
    }

    private function pathFormatting($path)
    {
        $prefix = '/' . trim(Admin::config('admin.route.prefix'), '/');

        $prefix = ($prefix === '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || $path === '') {
            return $prefix ?: '/';
        }
        return $prefix . '/' . $path;
    }
}
