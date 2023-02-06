<?php

namespace Slowlyo\SlowAdmin;

use Illuminate\Support\Arr;
use Slowlyo\SlowAdmin\Libs\Context;
use Illuminate\Support\Facades\Auth;
use Slowlyo\SlowAdmin\Libs\Composer;
use Slowlyo\SlowAdmin\Extend\Manager;
use Slowlyo\SlowAdmin\Models\AdminUser;
use Slowlyo\SlowAdmin\Models\AdminMenu;
use Slowlyo\SlowAdmin\Libs\JsonResponse;
use Slowlyo\SlowAdmin\Extend\ServiceProvider;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Slowlyo\SlowAdmin\Services\AdminMenuService;
use Slowlyo\SlowAdmin\Services\AdminSettingService;

class SlowAdmin
{
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
            $list = $user->roles->pluck('permissions')->flatten()->pluck('menus')->flatten()->sortBy('order');
        }

        return $this->list2Menu($list);
    }

    private function list2Menu($list, $parentId = 0, $parentName = ''): array
    {
        $data = [];
        foreach ($list as $key => $item) {
            if ($item['parent_id'] == $parentId) {
                $isLink = $item['url_type'] == AdminMenu::TYPE_LINK;
                $_temp  = [
                    'name'      => implode('-', array_filter([$parentName, "[{$item['id']}]"])),
                    'path'      => $isLink ? '/_link' : $item['url'],
                    'component' => 'amis',
                    'is_home'   => $item['is_home'],
                    'meta'      => [
                        'href'         => $isLink ? $item['url'] : '',
                        'title'        => $item['title'],
                        'icon'         => $item['icon'] ?? ' ',
                        'hide'         => $item['visible'] == 0,
                        'order'        => $item['order'],
                        'singleLayout' => $parentId != 0 ? '' : 'basic',
                    ],
                ];

                $children = $this->list2Menu($list, (int)$item['id'], $_temp['name']);

                if (!empty($children)) {
                    $_temp['component']            = $parentId == 0 ? 'basic' : 'multi';
                    $_temp['meta']['singleLayout'] = '';
                    $_temp['children']             = $children;
                }

                $data[] = $_temp;
                array_push($data, ...$this->generateMenus($_temp));
                unset($list[$key]);
            }
        }
        return $data;
    }

    public function generateMenus($item): array
    {
        $url = $item['path'] ?? '';
        if (!$url) {
            return [];
        }

        $title = $item['meta']['title'] ?? '';

        return [
            [
                'name'      => $item['name'] . '-create',
                'path'      => $url . "/create",
                'component' => 'amis',
                'meta'      => [
                    'title'        => $title . '-' . __('admin.create'),
                    'hide'         => true,
                    'icon'         => Arr::get($item, 'meta.icon'),
                    'singleLayout' => Arr::get($item, 'meta.singleLayout'),
                ],
            ],
            [
                'name'      => $item['name'] . '-show',
                'path'      => $url . '/:id',
                'component' => 'amis',
                'meta'      => [
                    'title'        => $title . '-' . __('admin.show'),
                    'hide'         => true,
                    'icon'         => Arr::get($item, 'meta.icon'),
                    'singleLayout' => Arr::get($item, 'meta.singleLayout'),
                ],
            ],
            [
                'name'      => $item['name'] . '-edit',
                'path'      => $url . '/:id/edit',
                'component' => 'amis',
                'meta'      => [
                    'title'        => $title . '-' . __('admin.edit'),
                    'hide'         => true,
                    'icon'         => Arr::get($item, 'meta.icon'),
                    'singleLayout' => Arr::get($item, 'meta.singleLayout'),
                ],
            ],
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
