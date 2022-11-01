<?php

namespace Slowlyo\SlowAdmin;

use Slowlyo\SlowAdmin\Traits\Assets;
use Illuminate\Support\Facades\Auth;
use Slowlyo\SlowAdmin\Traits\Layouts;
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

        $theme = config('admin.layout.theme');
        if (!$theme || $theme == 'default') {
            $theme = '';
        }
        $this->setVariable('systemTheme', $theme);

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
            if ($item['parent_id'] == $parentId) {
                $children = $this->list2Menu($list, (int)$item['id']);

                $_temp = [
                    'name'      => $item['title'],
                    'path'      => $item['url'],
                    'icon'      => $item['icon'],
                    'component' => 'Amis',
                ];

                if (!empty($children)) {
                    $_temp['routes'] = $children;
                }

                $data[] = $_temp;
                array_push($data, ...$this->generateMenus($_temp['path']));
                unset($list[$key]);
            }
        }
        return $data;
    }

    public function generateMenus($url): array
    {
        if (!$url) {
            return [];
        }

        return [
            [
                'path'      => $url . "/create",
                'component' => 'Amis',
            ],
            [
                'path'      => $url . '/:id',
                'component' => 'Amis',
            ],
            [
                'path'      => $url . '/:id/edit',
                'component' => 'Amis',
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
