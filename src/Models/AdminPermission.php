<?php

namespace Slowlyo\OwlAdmin\Models;

use Illuminate\Support\Str;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'http_method' => 'array',
        'http_path'   => 'array',
    ];

    protected $fillable = ['sign'];

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(AdminMenu::class, 'admin_permission_menu', 'permission_id', 'menu_id')
            ->withTimestamps();
    }

    public function shouldPassThrough(Request $request): bool
    {
        if (empty($this->http_path)) {
            // 未配置 http_path 时不放行，避免误授全局权限
            return false;
        }
        $method  = $this->http_method;
        $matches = array_map(function ($path) use ($method) {
            $path = trim(Admin::config('admin.route.prefix'), '/') . $path;
            if (Str::contains($path, ':')) {
                [$method, $path] = explode(':', $path);
                $method = explode(',', $method);
            }
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
        static::deleting(function ($model) {
            $model->menus()->detach();
        });
    }
}
