<?php

namespace Slowlyo\OwlAdmin\Models;

class Extension extends BaseModel
{
    const CACHE_KEY = 'admin_extensions';

    protected $fillable = ['name', 'is_enabled', 'options'];

    protected $casts = [
        'options' => 'json',
    ];

    protected $table = 'admin_extensions';

    protected static function boot()
    {
        parent::boot();

        $clearCache = function () {
            cache()->forget(self::CACHE_KEY);
        };

        static::created($clearCache);
        static::updated($clearCache);
        static::deleted($clearCache);
    }

    public static function keyByNameList()
    {
        return cache()->rememberForever(self::CACHE_KEY, fn() => self::all()->keyBy('name'));
    }
}
