<?php

namespace Slowlyo\OwlAdmin\Models;

use Illuminate\Support\Collection;

class Extension extends BaseModel
{
    const CACHE_KEY = 'admin_extensions';

    protected $fillable = ['name', 'is_enabled', 'options'];

    protected $casts = [
        'options' => 'json',
    ];

    protected $table = 'admin_extensions';

    /**
     * 注册模型事件并清理扩展缓存。
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(fn() => static::clearCache());
        static::updated(fn() => static::clearCache());
        static::deleted(fn() => static::clearCache());
    }

    /**
     * 清理扩展缓存。
     *
     * @return void
     */
    protected static function clearCache(): void
    {
        cache()->forget(self::CACHE_KEY);
    }

    /**
     * 获取以扩展名为键的扩展列表。
     *
     * @return Collection
     */
    public static function keyByNameList(): Collection
    {
        $payload = static::normalizeCachePayload(cache()->get(self::CACHE_KEY));

        // 缓存结构异常时直接重建，避免命中 Laravel 13 的反序列化限制。
        if ($payload === null) {
            $payload = static::buildCachePayload();
            cache()->forever(self::CACHE_KEY, $payload);
        }

        return static::hydrate($payload)->keyBy('name');
    }

    /**
     * 获取已启用扩展名称。
     *
     * @return array
     */
    public static function getEnabledNames()
    {
        $list = self::keyByNameList();

        $enabled = [];
        foreach ($list as $item) {
            // 仅返回已启用扩展，避免上层误读禁用状态。
            if ($item->is_enabled) {
                $enabled[] = $item->name;
            }
        }

        return $enabled;
    }

    /**
     * 构建可安全序列化的缓存数据。
     *
     * @return array
     */
    protected static function buildCachePayload(): array
    {
        return static::query()
            ->get()
            ->map(fn(self $extension) => $extension->getAttributes())
            ->values()
            ->all();
    }

    /**
     * 规范化缓存数据，兼容旧版本直接缓存模型集合的场景。
     *
     * @param mixed $payload
     * @return array|null
     */
    protected static function normalizeCachePayload(mixed $payload): ?array
    {
        // 新缓存仅接受纯数组，避免依赖可反序列化类白名单。
        if (is_array($payload)) {
            return collect($payload)->every(fn($item) => is_array($item)) ? $payload : null;
        }

        // 旧缓存若还是模型集合，则在本次读取时平滑迁移为数组。
        if ($payload instanceof Collection && $payload->every(fn($item) => $item instanceof self)) {
            $payload = $payload
                ->map(fn(self $extension) => $extension->getAttributes())
                ->values()
                ->all();

            cache()->forever(self::CACHE_KEY, $payload);

            return $payload;
        }

        return null;
    }
}
