<?php

namespace Slowlyo\OwlAdmin\Middleware;

use Closure;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Http\Request;
use Slowlyo\Support\SqlRecord;
use Slowlyo\OwlAdmin\Support\Cores\Api;
use Slowlyo\OwlAdmin\Support\Apis\AdminBaseApi;

class Bootstrap
{
    public function handle(Request $request, Closure $next)
    {
        // 重置长驻进程下的单例状态，避免跨请求状态累积 (Octane)
        if (app()->bound('admin.asset')) {
            app('admin.asset')->flush();
        }
        if (app()->bound('admin.menu')) {
            app('admin.menu')->flush();
        }
        if (app()->bound('admin.context')) {
            app('admin.context')->flush();
        }

        // 重新初始化 Api 注册（因上面清空了 context）
        Api::boot();

        // 清理 AdminBaseApi 的静态缓存，避免跨请求陈旧
        AdminBaseApi::$apiRecord = null;

        // 重置 SQL 记录
        SqlRecord::$sql = [];

        Admin::bootstrap();

        return $next($request);
    }
}
