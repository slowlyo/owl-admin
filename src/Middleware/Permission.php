<?php

namespace Slowlyo\OwlAdmin\Middleware;

use Str;
use Closure;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Slowlyo\OwlAdmin\OwlAdmin;
use Slowlyo\OwlAdmin\Models\AdminPermission;

class Permission
{
    protected string $middlewarePrefix = 'admin.permission:';

    public function handle(Request $request, Closure $next, ...$args)
    {
        if (config('admin.auth.enable') === false) {
            return $next($request);
        }

        $user = OwlAdmin::user();

        if (!empty($args) || $this->shouldPassThrough($request) || $this->checkRoutePermission($request) || $user?->isAdministrator()) {
            return $next($request);
        }

        if (!$user?->allPermissions()
            ->first(fn(AdminPermission $permission) => $permission->shouldPassThrough($request))) {

            return OwlAdmin::response()->fail('无权访问');
        }

        return $next($request);
    }

    public function checkRoutePermission(Request $request): bool
    {
        if (!$middleware = collect($request->route()?->middleware())->first(function ($middleware) {
            return Str::startsWith($middleware, $this->middlewarePrefix);
        })) {
            return false;
        }

        $args = explode(',', str_replace($this->middlewarePrefix, '', $middleware));

        $method = array_shift($args);

        if (!method_exists(AdminPermission::class, $method)) {
            throw new InvalidArgumentException("Invalid permission method [$method].");
        }

        call_user_func([AdminPermission::class, $method], $args);

        return true;
    }

    protected function shouldPassThrough($request): bool
    {
        if ($request->path() == config('admin.route.prefix')) {
            return true;
        }

        $excepts = config('admin.auth.except', []);

        $devTools = [];
        if (config('admin.show_development_tools')) {
            $devTools = ['/dev_tools*'];
        }

        return collect($excepts)->merge([
            'menus',
            'current-user',
            'login',
            'logout',
            'no-content',
            '_settings',
            'upload_rich',
            'captcha',
            ...$devTools,
        ])->map(function ($path) {
            $prefix = '/' . trim(config('admin.route.prefix'), '/');

            $prefix = ($prefix === '/') ? '' : $prefix;

            $path = trim($path, '/');

            if (is_null($path) || $path === '') {
                return $prefix ?: '/';
            }
            return $prefix . '/' . $path;
        })->contains(function ($except) use ($request) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }
            return $request->is($except);
        });
    }
}
