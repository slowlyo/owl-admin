<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Slowlyo\SlowAdmin\SlowAdmin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexController extends AdminController
{
    public function menus(): JsonResponse|JsonResource
    {
        $menus = [
            [
                'path'     => '/',
                'redirect' => '/dashboard',
            ],
            [
                'path'      => '/user_setting',
                'component' => 'Amis',
            ],
        ];

        array_push($menus, ...SlowAdmin::make()->getMenus());

        if (config('admin.show_development_tools')) {
            $menus[] = $this->devTools();
        }

        return $this->response()->success($menus);
    }

    public function noContent(): JsonResponse|JsonResource
    {
        return $this->response()->successMessage();
    }

    public function devTools(): array
    {
        return [
            'name'   => __('admin.developer'),
            'path'   => '/dev_tools',
            'icon'   => 'fa-brands fa-dev',
            'routes' => [
                [
                    'name'      => __('admin.code_generator'),
                    'path'      => '/dev_tools/code_generator',
                    'icon'      => 'fa-solid fa-robot',
                    'component' => 'Amis',
                ],
            ],
        ];
    }

    public function settings(): JsonResponse|JsonResource
    {
        $settings = [
            'app_name'     => config('admin.name'),
            'logo'         => url(config('admin.logo')),
        ];

        return $this->response()->success($settings);
    }
}
