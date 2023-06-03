<?php

namespace Slowlyo\OwlAdmin\Libs\CodeGenerator;

use Illuminate\Support\Facades\Artisan;
use Slowlyo\OwlAdmin\Services\AdminMenuService;

class RouteGenerator
{
    public static function handle($menuInfo)
    {
        if (!$menuInfo['enabled']) {
            return;
        }

        // 创建菜单
        $adminMenuService = AdminMenuService::make();

        if (!$adminMenuService->getModel()->query()->where('url', $menuInfo['route'])->exists()) {
            $adminMenuService->store([
                'title'     => $menuInfo['title'],
                'icon'      => $menuInfo['icon'],
                'parent_id' => $menuInfo['parent_id'],
                'url'       => $menuInfo['route'],
                'order'     => 100,
            ]);
        }

        if ($adminMenuService->hasError()) {
            abort(500, $adminMenuService->getError());
        }

        // 刷新路由
        Artisan::call('admin:gen-route');
    }
}
