<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

use Illuminate\Support\Str;
use Slowlyo\OwlAdmin\Services\AdminService;
use Slowlyo\OwlAdmin\Services\AdminApiService;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;

abstract class AdminBaseApi implements AdminApiInterface
{
    /** @var string 接口名称 */
    public string $title = '';

    public string $method = 'any';

    public static $apiRecord = [];

    /**
     * 获取接口名称
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title ?: Str::of(static::class)->explode('\\')->pop();
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getApiRecord()
    {
        if (!is_array(self::$apiRecord)) {
            // Bootstrap 会在每次请求开始时清空静态缓存，这里兼容旧的 null 重置方式。
            self::$apiRecord = [];
        }

        if (!array_key_exists(static::class, self::$apiRecord)) {
            self::$apiRecord[static::class] = AdminApiService::make()->getApiByTemplate(static::class);
        }

        return self::$apiRecord[static::class];
    }

    public function setApiRecord($apiRecord)
    {
        if (!is_array(self::$apiRecord)) {
            // Bootstrap 清理后首次写入时恢复数组结构，避免动态 API 模板共享同一条记录。
            self::$apiRecord = [];
        }

        self::$apiRecord[static::class] = $apiRecord;

        return $this;
    }

    /**
     * 获取接口参数, 可以通过传入 xxx.xxx 的方式获取指定参数
     *
     * @param mixed $key
     * @param mixed $default
     *
     * @return array|HigherOrderBuilderProxy|mixed
     */
    public function getArgs($key = null, $default = null)
    {
        $args = $this->getApiRecord()->args;

        if ($key) {
            return data_get($args, $key, $default);
        }

        return $args;
    }

    /**
     * 获取空白的 AdminService 实例
     *
     * @return AdminService
     */
    public function blankService()
    {
        return new class extends AdminService {
        };
    }
}
