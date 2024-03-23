<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Support\Str;
use Slowlyo\OwlAdmin\Services\AdminApiService;

/**
 * @property AdminApiService $service
 */
class AdminApiController extends AdminController
{
    public string $serviceName = AdminApiService::class;

    public function index()
    {
        $path = Str::of(request()->path())->replace(Admin::config('admin.route.prefix'), '')->ltrim('/')->value();
        $api  = $this->service->getApiByPath($path);

        if (!$api) {
            return $this->response()->success();
        }

        return $this->response()->success(app($api->template)->handle());
    }
}
