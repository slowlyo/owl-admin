<?php

namespace Slowlyo\OwlAdmin\Middleware;

use Closure;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Http\Response;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (Admin::permission()->authIntercept($request)) {
            return Admin::response()
                ->additional(['code' => Response::HTTP_UNAUTHORIZED])
                ->doNotDisplayToast()
                ->fail(__('admin.please_login'));
        }

        Admin::permission()->checkUserStatus();

        return $next($request);
    }
}
