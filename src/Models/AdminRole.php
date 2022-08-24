<?php

namespace Slowlyo\SlowAdmin\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class AdminRole extends BaseModel
{
    use HasTimestamps;

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(AdminPermission::class, 'admin_role_permissions', 'role_id', 'permission_id')
            ->withTimestamps();
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function (AdminRole $model) {
            $model->permissions()->detach();
        });
    }
}
