<?php

namespace Slowlyo\OwlAdmin\Middleware;

use Closure;
use Illuminate\Http\Request;
use Slowlyo\OwlAdmin\OwlAdmin;

class Bootstrap
{
    public function handle(Request $request, Closure $next)
    {
        OwlAdmin::bootstrap();

        return $next($request);
    }

}
