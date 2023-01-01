<?php

namespace Slowlyo\SlowAdmin\Middleware;

use Closure;
use Slowlyo\SlowAdmin\SlowAdmin;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (config('admin.auth.enable')) {
            if (!$this->shouldPassThrough($request) && SlowAdmin::guard()->guest()) {
                return SlowAdmin::response()->additional(['code' => '401'])->fail('请先登录');
            }
        }

        return $next($request);
    }

    protected function shouldPassThrough($request): bool
    {
        $excepts = config('admin.auth.except', []);

        return collect($excepts)
            ->merge([
                'login',
                'logout',
                'no-content',
                '_settings',
                'upload_rich',
            ])
            ->map(function ($path) {
                $prefix = '/' . trim(config('admin.route.prefix'), '/');

                $prefix = ($prefix === '/') ? '' : $prefix;

                $path = trim($path, '/');

                if (is_null($path) || $path === '') {
                    return $prefix ?: '/';
                }
                return $prefix . '/' . $path;
            })
            ->contains(function ($except) use ($request) {
                if ($except !== '/') {
                    $except = trim($except, '/');
                }
                return $request->is($except);
            });
    }


}
