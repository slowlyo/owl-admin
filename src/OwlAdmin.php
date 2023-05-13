<?php

namespace Slowlyo\OwlAdmin;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Libs\Context;
use Illuminate\Support\Facades\Auth;
use Slowlyo\OwlAdmin\Libs\Composer;
use Slowlyo\OwlAdmin\Traits\Assets;
use Slowlyo\OwlAdmin\Extend\Manager;
use Slowlyo\OwlAdmin\Models\AdminUser;
use Slowlyo\OwlAdmin\Models\AdminMenu;
use Slowlyo\OwlAdmin\Libs\JsonResponse;
use Slowlyo\OwlAdmin\Extend\ServiceProvider;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Slowlyo\OwlAdmin\Services\AdminSettingService;

class OwlAdmin
{
    use Assets;

    public static function make(): static
    {
        return new static();
    }

    public static function response(): JsonResponse
    {
        return new JsonResponse();
    }

    /**
     * 获取系统菜单
     *
     * @return array
     */
    public function getMenus(): array
    {
        $user = self::user();
        if ($user->isAdministrator() || config('admin.auth.enable') === false) {
            $list = AdminMenuService::make()->query()->orderBy('order')->get();
        } else {
            $user->load('roles.permissions.menus');
            $list =
                $user->roles->pluck('permissions')->flatten()->pluck('menus')->flatten()->unique('id')->sortBy('order');
        }

        return $this->list2Menu($list);
    }

    private function list2Menu($list, $parentId = 0, $parentName = ''): array
    {
        $data = [];
        foreach ($list as $key => $item) {
            if ($item['parent_id'] == $parentId) {
                $idStr = "[{$item['id']}]";
                $_temp = [
                    'name'      => $parentName ? $parentName . '-' . $idStr : $idStr,
                    'path'      => $item['url'],
                    'component' => 'amis',
                    'is_home'   => $item['is_home'],
                    'is_link'   => $item['url_type'] == AdminMenu::TYPE_LINK,
                    'meta'      => [
                        'title' => $item['title'],
                        'icon'  => $item['icon'] ?? '-',
                        'hide'  => $item['visible'] == 0,
                        'order' => $item['order'],
                    ],
                ];

                $children = $this->list2Menu($list, (int)$item['id'], $_temp['name']);

                if (!empty($children)) {
                    $_temp['component'] = 'amis';
                    $_temp['children']  = $children;
                }

                $data[] = $_temp;
                if (!in_array($_temp['path'], config('admin.route.without_extra_routes'))) {
                    array_push($data, ...$this->generateMenus($_temp));
                }
                unset($list[$key]);
            }
        }
        return $data;
    }

    public function generateMenus($item): array
    {
        $url = $item['path'] ?? '';

        if (!$url || array_key_exists('children', $item)) {
            return [];
        }

        $menu = fn($action, $path) => [
            'name'      => $item['name'] . '-' . $action,
            'path'      => $url . $path,
            'component' => 'amis',
            'meta'      => [
                'hide'  => true,
                'icon'  => Arr::get($item, 'meta.icon'),
                'title' => Arr::get($item, 'meta.title') . ' - ' . __('admin.' . $action),
            ],
        ];

        return [
            $menu('create', '/create'),
            $menu('show', '/:id'),
            $menu('edit', '/:id/edit'),
        ];
    }

    public static function guard(): \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
    {
        return Auth::guard(config('admin.auth.guard') ?: 'admin');
    }

    public static function user(): \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null|AdminUser
    {
        return static::guard()->user();
    }

    public static function bootstrap()
    {
        $file = config('admin.bootstrap');

        if (is_file($file)) {
            require config('admin.bootstrap');
        }
    }

    /**
     * @param string|null $name
     *
     * @return Manager|ServiceProvider|null
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function extension(?string $name = '')
    {
        if ($name) {
            return app('admin.extend')->get($name);
        }

        return app('admin.extend');
    }

    public static function classLoader()
    {
        return Composer::loader();
    }

    /**
     * 上下文管理.
     *
     * @return Context
     */
    public static function context()
    {
        return app('admin.context');
    }

    /**
     * 往分组插入中间件.
     *
     * @param array $mix
     */
    public static function mixMiddlewareGroup(array $mix = [])
    {
        $router = app('router');
        $group  = $router->getMiddlewareGroups()['admin'] ?? [];

        if ($mix) {
            $finalGroup = [];

            foreach ($group as $i => $mid) {
                $next = $i + 1;

                $finalGroup[] = $mid;

                if (!isset($group[$next]) || $group[$next] !== 'admin.permission') {
                    continue;
                }

                $finalGroup = array_merge($finalGroup, $mix);

                $mix = [];
            }

            if ($mix) {
                $finalGroup = array_merge($finalGroup, $mix);
            }

            $group = $finalGroup;
        }

        $router->middlewareGroup('admin', $group);
    }

    /**
     * @return AdminSettingService
     */
    public static function setting()
    {
        return app('admin.setting');
    }
}
