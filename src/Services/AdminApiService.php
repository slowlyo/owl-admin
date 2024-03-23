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

        admin_abort_if($exists || in_array(ltrim($data['path'], '/'), $routes), '接口路径已存在');
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
        return $this->query()->where('path', $path)->first();
    }

    public function getApiByTemplate($template)
    {
        return $this->query()->where('template', $template)->first();
    }
}
