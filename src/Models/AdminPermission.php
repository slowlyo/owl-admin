<?php

namespace Slowlyo\OwlAdmin\Models;

use Illuminate\Support\Str;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Http\Request;

class AdminPermission extends BaseModel
{
    public static array $httpMethods = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
        'PATCH',
        'OPTIONS',
        'HEAD',
    ];

    protected $casts = [
        'http_path' => 'array',
    ];

    public static $base_permission = [
        ['value'=>'create', 'label' =>'新增'],
        ['value'=>'edit', 'label' =>'编辑'],
        ['value'=>'delete', 'label' =>'删除'],
        ['value'=>'batchDel', 'label' =>'批量删除'],
        ['value'=>'show', 'label' =>'详情'],
        ['value'=>'export', 'label' =>'导出'],
    ];

    public function menu(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AdminMenu::class, 'menu_id');
    }

    public function shouldPassThrough(Request $request): bool
    {
        if (empty($this->http_path)) {
            return true;
        }

        $method = '';
        $matches = array_map(function ($path) use ($method) {
            if (Str::contains($path, ':')) {
                [$method, $path] = explode(':', $path);
            }
            $path = trim(Admin::config('admin.route.prefix'), '/') . $path;
            return compact('method', 'path');
        }, $this->http_path);

        foreach ($matches as $match) {
            if ($this->matchRequest($match, $request)) {
                return true;
            }
        }
        return false;
    }

    protected function matchRequest(array $match, Request $request): bool
    {
        if ($match['path'] == '/') {
            $path = '/';
        } else {
            $path = trim($match['path'], '/');
        }
        if (!$request->is($path)) {
            return false;
        }
        $method = collect($match['method'])->filter()->map(function ($method) {
            return strtoupper($method);
        });
        return $method->isEmpty() || $method->contains($request->method());
    }

    protected static function boot(): void
    {
        parent::boot();
    }
}
