<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Illuminate\Http\Request;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\OwlAdmin;
use Illuminate\Http\JsonResponse;
use Slowlyo\OwlAdmin\Models\Extension;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexController extends AdminController
{
    public function menus(): JsonResponse|JsonResource
    {
        $menus = [
            [
                'name'      => 'user_setting',
                'path'      => '/user_setting',
                'component' => 'amis',
                'meta'      => [
                    'hide'         => true,
                    'title'        => __('admin.user_setting'),
                    'icon'         => 'material-symbols:manage-accounts',
                    'singleLayout' => 'basic',
                ],
            ],
        ];

        array_push($menus, ...OwlAdmin::make()->getMenus());

        if (config('admin.show_development_tools')) {
            $menus[] = $this->devTools();
        }

        return $this->response()->success($menus);
    }

    public function noContentResponse(): JsonResponse|JsonResource
    {
        return $this->response()->successMessage();
    }

    public function devTools(): array
    {
        return [
            'name'      => 'dev_tools',
            'path'      => '/dev_tools',
            'component' => 'basic',
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
        ];
    }

    public function settings(): JsonResponse|JsonResource
    {
        return $this->response()->success([
            'nav'      => Admin::getNav(),
            'assets'   => Admin::getAssets(),
            'app_name' => config('admin.name'),
            'locale'   => config('app.locale'),
            'layout'   => config('admin.layout'),
            'logo'     => url(config('admin.logo')),

            'login_captcha'          => config('admin.auth.login_captcha'),
            'show_development_tools' => config('admin.show_development_tools'),
            'system_theme_setting'   => Admin::setting()->get('system_theme_setting'),
            'enabled_extensions'     => Extension::query()->where('is_enabled', 1)->pluck('name')?->toArray(),
        ]);
    }

    /**
     * 保存设置项
     *
     * @param Request $request
     *
     * @return JsonResponse|JsonResource
     */
    public function saveSettings(Request $request)
    {
        Admin::setting()->setMany($request->all());

        return $this->response()->successMessage();
    }

    /**
     * 下载导出文件
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadExport(Request $request)
    {
        return response()->download(storage_path('app/' . $request->input('path')))->deleteFileAfterSend();
    }
}
