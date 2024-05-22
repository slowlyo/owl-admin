<?php

namespace Slowlyo\OwlAdmin\Services;

use Slowlyo\OwlAdmin\Models\AdminApi;
use Illuminate\Database\Eloquent\Builder;
use Slowlyo\OwlAdmin\Models\AdminCodeGenerator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\RouteGenerator;

/**
 * @method AdminApi getModel()
 * @method AdminApi|Builder query()
 */
class AdminApiService extends AdminService
{
    protected string $modelName = AdminApi::class;

    public function saving(&$data, $primaryKey = '')
    {
        $exists = $this->query()
            ->where('path', $data['path'])
            ->when($primaryKey, fn($q) => $q->where('id', '<>', $primaryKey))
            ->exists();

        $routes = AdminCodeGenerator::query()->get()->map(function ($item) {
            return $item->menu_info['enabled'] ? ltrim($item->menu_info['route'], '/') : '';
        })->filter()->toArray();

        admin_abort_if($exists || in_array(ltrim($data['path'], '/'), $routes), admin_trans('admin.apis.path_exists'));
    }

    public function saved($model, $isEdit = false)
    {
        RouteGenerator::refresh();
    }

    public function deleted($ids)
    {
        RouteGenerator::refresh();
    }

    public function getApiByPath($path)
    {
        $api = $this->query()->where('path', $path)->first();

        if (!$api && str_starts_with($path, '/')) {
            $api = $this->query()->where('path', ltrim($path, '/'))->first();
        }

        return $api;
    }

    public function getApiByTemplate($template)
    {
        return $this->query()->where('template', $template)->first();
    }
}
