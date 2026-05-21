<?php

namespace Slowlyo\OwlAdmin\Middleware;

use Closure;
use Illuminate\Http\Request;

class IframeToken
{
    /**
     * iframe 原生请求无法设置 Authorization 头，这里只把同源 iframe 页面传入的 token 转成 Bearer 头。
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->query('_iframe_token');

        if ($token && !$request->bearerToken()) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        return $next($request);
    }
}
