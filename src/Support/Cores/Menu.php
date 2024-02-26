<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Services\AdminMenuService;

class Menu
{
    protected array $menus = [];

    public function all()
    {
        $menus = $this->userMenus()
            ->push(...array_map(fn($item) => $this->formatItem($item), $this->menus))
            ->sortBy('order')
            ->values()
            ->toArray();

        return array_merge($this->list2Menu($menus), $this->extra());
    }

    public function userMenus()
    {
        if (!Admin::config('admin.auth.enable')) {
            return collect([]);
        }

        $user = Admin::user();
        if ($user->isAdministrator() || Admin::config('admin.auth.permission') === false) {
            $list = AdminMenuService::make()->query()->orderBy('order')->get();
        } else {
            $user->load('roles.permissions.menus');
            $list = $user->roles
                ->pluck('permissions')
                ->flatten()
                ->pluck('menus')
                ->flatten()
                ->unique('id')
                ->sortBy('order');
        }

        return $list;
    }

    public function list2Menu($list, $parentId = 0, $parentName = ''): array
    {
        $data = [];
        foreach ($list as $key => $item) {
            if ($item['parent_id'] == $parentId) {
                $idStr = "[{$item['id']}]";
                $_temp = [
                    'name'      => $parentName ? $parentName . '-' . $idStr : $idStr,
                    'path'      => $item['url'],
                    'component' => data_get($item, 'component') ?? 'amis',
                    'is_home'   => $item['is_home'],
                    'is_full'   => $item['is_full'] ?? 0,
                    'is_link'   => $item['url_type'] == Admin::adminMenuModel()::TYPE_LINK,
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
                if (!in_array($_temp['path'], Admin::config('admin.route.without_extra_routes'))) {
                    array_push($data, ...$this->generateRoute($_temp));
                }
                unset($list[$key]);
            }
        }
        return $data;
    }

    public function generateRoute($item): array
    {
        $url = $item['path'] ?? '';
        $url = preg_replace('/\?.*/', '', $url);

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

    public function add($menus)
    {
        $this->menus = array_merge($this->menus, $menus);

        return $this;
    }

    public function formatItem($item)
    {
        return array_merge([
            'title'     => '',
            'url'       => '',
            'url_type'  => 1,
            'icon'      => '',
            'parent_id' => 0,
            'id'        => 999,
            'is_home'   => 0,
            'visible'   => 1,
            'order'     => 99,
        ], $item);
    }

    /**
     * 额外菜单
     *
     * @return array|array[]
     */
    public function extra()
    {
        $extraMenus = [];

        if (Admin::config('admin.auth.enable')) {
            $extraMenus[] = [
                'name'      => 'user_setting',
                'path'      => '/user_setting',
                'component' => 'amis',
                'meta'      => [
                    'hide'         => true,
                    'title'        => __('admin.user_setting'),
                    'icon'         => 'material-symbols:manage-accounts',
                    'singleLayout' => 'basic',
                ],
            ];
        }

        if (Admin::config('admin.show_development_tools')) {
            $extraMenus = array_merge($extraMenus, $this->devToolMenus());
        }

        return $extraMenus;
    }

    /**
     * 开发者工具菜单
     *
     * @return array[]
     */
    public function devToolMenus()
    {
        return [
            [
                'name'      => 'dev_tools',
                'path'      => '/dev_tools',
                'component' => 'amis',
                'meta'      => [
                    'title' => __('admin.developer'),
                    'icon'  => 'fluent:window-dev-tools-20-regular',
                ],
                'children'  => [
                    [
                        'name'      => 'dev_tools_extensions',
                        'path'      => '/dev_tools/extensions',
                        'component' => 'amis',
                        'meta'      => [
                            'title' => __('admin.extensions.menu'),
                            'icon'  => 'ion:extension-puzzle-outline',
                        ],
                    ],
                    [
                        'name'      => 'dev_tools_code_generator',
                        'path'      => '/dev_tools/code_generator',
                        'component' => 'amis',
                        'meta'      => [
                            'title' => __('admin.code_generator'),
                            'icon'  => 'ic:baseline-code',
                        ],
                    ],
                    [
                        'name'      => 'dev_tools_editor',
                        'path'      => '/dev_tools/editor',
                        'component' => 'editor',
                        'meta'      => [
                            'title' => __('admin.visual_editor'),
                            'icon'  => 'mdi:monitor-edit',
                        ],
                    ],
                ],
            ],
        ];
    }
}
