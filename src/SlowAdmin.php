<?php

namespace Slowlyo\SlowAdmin;

use Slowlyo\SlowAdmin\Traits\Assets;
use Illuminate\Support\Facades\Auth;
use Slowlyo\SlowAdmin\Traits\Layouts;
use Slowlyo\SlowAdmin\Models\AdminMenu;
use Slowlyo\SlowAdmin\Models\AdminUser;
use Slowlyo\SlowAdmin\Libs\JsonResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Slowlyo\SlowAdmin\Services\AdminMenuService;

class SlowAdmin
{
    use Assets, Layouts;

    /** @var array 页面参数 */
    private static array $variable = [];

    public static function make(): static
    {
        return new static();
    }

    public function setVariable($key, $value): static
    {
        static::$variable[$key] = $value;

        return $this;
    }

    public function render($view = 'slow-admin::index'): Factory|View|Application
    {
        $this->setVariable('css', static::getCss());
        $this->setVariable('js', static::getJs());

        return view($view, static::$variable);
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
            $list = AdminMenuService::make()->query()->orderByDesc('order')->get();
        } else {
            $user->load('roles.permissions.menus');
            $list = $user->roles->pluck('permissions')->flatten()->pluck('menus')->flatten()->sortByDesc('order');
        }

        return $this->list2Menu($list);
    }

    private function list2Menu($list, $parentId = 0): array
    {
        $data = [];
        foreach ($list as $key => $item) {
            if ($item->parent_id == $parentId) {
                $children = $this->list2Menu($list, (int)$item->id);
                $_temp    = [];

                if (!empty($children)) {
                    $needShow = collect($children)->where('visible', true)->count();
                    if ($needShow == 0) {
                        array_push($data, ...$children);
                        $children = null;
                    }
                }

                if (!empty($children)) {
                    $_temp['children'] = [
                        [
                            'label'    => $item->title,
                            'icon'     => $item->icon,
                            'children' => $children,
                        ],
                    ];

                    if ($item->parent_id != 0) {
                        $_temp = $_temp['children'][0];
                    }
                } else {
                    $_temp['children'] = [
                        'label'   => $item->title,
                        'icon'    => $item->icon,
                        'visible' => (bool)$item->visible,
                    ];

                    // 外链 || 路由
                    if ($item->url_type == AdminMenu::TYPE_LINK) {
                        $_temp['children']['link'] = $item->url;
                    } else {
                        $_temp['children']['url']       = $item->url;
                        $_temp['children']['schemaApi'] = url(config('admin.route.prefix') . $item->api);
                    }

                    $menus = $this->generateMenus($item->url);

                    if ($item->parent_id == 0) {
                        $_temp['children'] = [$_temp['children']];
                        $menus             = array_map(fn($value) => ['children' => [$value]], $menus);
                    } else {
                        $_temp = $_temp['children'];
                    }
                    array_push($data, ...$menus);
                }
                $data[] = $_temp;
                unset($list[$key], $_temp);
            }
        }
        return $data;
    }

    public function generateMenus($url): array
    {
        $prefix = config('admin.route.prefix');

        return [
            [
                'url'       => $url . "/create",
                'visible'   => false,
                'schemaApi' => url($prefix . $url . '/create'),
            ],
            [
                'url'       => $url . '/:id',
                'visible'   => false,
                'schemaApi' => url($prefix . $url . '/${params.id}'),
            ],
            [
                'url'       => $url . '/:id/edit',
                'visible'   => false,
                'schemaApi' => url($prefix . $url . '/${params.id}/edit'),
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
}
