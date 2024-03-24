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

    public static $apiRecord;

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
        if (!self::$apiRecord) {
            self::$apiRecord = AdminApiService::make()->getApiByTemplate(static::class);
        }

        return self::$apiRecord;
    }

    /**
     * 获取接口参数, 可以通过传入 xxx.xxx 的方式获取指定参数
     *
     * @param null $key
     * @param null $default
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
