<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Models\Extension;

class IndexController extends AdminController
{
    public function menus(): JsonResponse|JsonResource
    {
        return $this->response()->success(Admin::menu()->all());
    }

    public function noContentResponse(): JsonResponse|JsonResource
    {
        return $this->response()->successMessage();
    }

    public function settings(): JsonResponse|JsonResource
    {
        return $this->response()->success([
            'nav' => Admin::getNav(),
            'assets' => Admin::getAssets(),
            'app_name' => config('admin.name'),
            'locale' => config('app.locale'),
            'layout' => config('admin.layout'),
            'logo' => url(config('admin.logo')),

            'login_captcha' => config('admin.auth.login_captcha'),
            'show_development_tools' => config('admin.show_development_tools'),
            'system_theme_setting' => Admin::setting()->get('system_theme_setting'),
            'enabled_extensions' => Extension::query()->where('is_enabled', 1)->pluck('name')?->toArray(),
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
