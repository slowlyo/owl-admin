<?php

namespace Slowlyo\SlowAdmin\Middleware;

use Closure;
use Illuminate\Http\Request;
use Slowlyo\SlowAdmin\SlowAdmin;

class Bootstrap
{
    public function handle(Request $request, Closure $next)
    {
        SlowAdmin::bootstrap();

        return $next($request);
    }

}
