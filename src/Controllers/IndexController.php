<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Slowlyo\SlowAdmin\SlowAdmin;
use Slowlyo\SlowAdmin\Renderers\Component;

class IndexController extends AdminController
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return SlowAdmin::make()->baseApp()->render();
    }


    public function base(): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        $menus = [
            [
                'url'      => '/',
                'redirect' => '/dashboard',
            ],
            [
                'url'       => '/user_setting',
                'schemaApi' => config('admin.route.prefix') . '/user_setting',
            ],
        ];

        array_push($menus, ...SlowAdmin::make()->getMenus());

        $component = Component::make()->setType('app')->pages($menus)->id('base-app-reload');

        return $this->response()->success($component);
    }

    public function noContent(): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        return $this->response()->successMessage();
    }
}
