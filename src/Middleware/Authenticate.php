<?php

namespace Slowlyo\SlowAdmin\Middleware;

use Closure;
use Slowlyo\SlowAdmin\SlowAdmin;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (config('admin.auth.enable')) {
            $redirectTo = config('admin.route.prefix') . '/login';

            if (!$this->shouldPassThrough($request) && SlowAdmin::guard()->guest()) {
                dump(auth('sanctum')->user());
                dd(auth('sanctum')->user());
                return redirect()->guest($redirectTo);
            }
        }

        return $next($request);
    }

    protected function shouldPassThrough($request): bool
    {
        $excepts = config('admin.auth.except', [
            '/login',
            '/logout',
        ]);

        return collect($excepts)
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
