<?php

namespace Slowlyo\OwlAdmin\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Slowlyo\OwlAdmin\Admin;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    public function __construct(array $attributes = [])
    {
        $this->setConnection(Admin::config('admin.database.connection'));

        parent::__construct($attributes);
    }

    public static function findToken($token)
    {
        if (!str_contains($token, '|')) {
            return static::where('token', hash('sha256', $token))->withInExpiration()->first();
        }

        [$id, $token] = explode('|', $token, 2);

        $instance = static::withInExpiration()->find($id);

        if ($instance) {
            return hash_equals($instance->token, hash('sha256', $token)) ? $instance : null;
        }

        return null;
    }

    public function scopeWithInExpiration($query)
    {
        $expiration = config('admin.auth.token_expiration');

        $query->when($expiration, fn($q) => $q->where('created_at', '>=', now()->subMinutes($expiration)));

        return $query;
    }
}
