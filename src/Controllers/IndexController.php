<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Slowlyo\OwlAdmin\Models\Extension;
use Illuminate\Support\Facades\Storage;
use Slowlyo\OwlAdmin\Services\AdminPageService;
use Illuminate\Http\Resources\Json\JsonResource;

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
        $localeOptions = Admin::config('admin.layout.locale_options') ?? [
            'en'    => 'English',
            'zh_CN' => '简体中文',
        ];

        $locale = settings()->getByModule('admin_locale', config('app.locale'));

        if (in_array($locale, ['null', 'undefined'])) {
            $locale = 'zh_CN';
        }

        return $this->response()->success([
            'nav'      => Admin::getNav(),
            'assets'   => Admin::getAssets(),
            'app_name' => Admin::config('admin.name'),
            'locale'   => $locale,
            'layout'   => Admin::config('admin.layout'),
            'logo'     => Admin::config('admin.logo') ? url(Admin::config('admin.logo')) : '',

            'login_captcha'          => Admin::config('admin.auth.login_captcha'),
            'locale_options'         => map2options($localeOptions),
            'show_development_tools' => Admin::config('admin.show_development_tools'),
            'system_theme_setting'   => settings()->getByModule('system_theme_setting'),
            'enabled_extensions'     => Extension::getEnabledNames(),
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
        $data          = $request->all();
        $currentModule = Admin::currentModule(true);

        $distinguishingModule = ['system_theme_setting', 'admin_locale'];
        foreach ($data as $key => $value) {
            if (in_array($key, $distinguishingModule) && $currentModule) {
                $data[$currentModule . '_' . $key] = $value;
                unset($data[$key]);
            }
        }

        Admin::setting()->setMany($data);

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
        $path = $request->input('path');

        try {
            Storage::exists($path);
        } catch (\Throwable $e) {
            abort(404);
        }

        $path = storage_path('app/' . $path);

        if (!file_exists($path)) abort(404);

        return response()->download($path)->deleteFileAfterSend();
    }

    /**
     * 图标搜索
     *
     * @return JsonResponse|JsonResource
     */
    public function iconifySearch()
    {
        $query = request('query', 'home');

        $icons = file_get_contents(owl_admin_path('/Support/iconify.json'));
        $icons = json_decode($icons, true);

        $items = [];
        foreach ($icons as $item) {
            if (str_contains($item, $query)) {
                $items[] = ['icon' => $item];
            }
            if (count($items) > 999) {
                break;
            }
        }

        $total = count($items);

        return $this->response()->success(compact('items', 'total'));
    }

    /**
     * 获取页面结构
     *
     * @return JsonResponse|JsonResource
     */
    public function pageSchema()
    {
        return $this->response()->success(AdminPageService::make()->get(request('sign')));
    }
}
