<?php

namespace Slowlyo\SlowAdmin\Traits;

/**
 * 错误信息Trait类
 */
trait ErrorTrait
{
    /**
     * 错误信息
     *
     * @var string
     */
    protected string $error = '';

    /**
     * 设置错误信息
     *
     * @param string $error
     *
     * @return bool
     */
    protected function setError(string $error): bool
    {
        $this->error = $error ?: '未知错误';
        return false;
    }

    /**
     * 获取错误信息
     *
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * 是否存在错误信息
     *
     * @return bool
     */
    public function hasError(): bool
    {
        return !empty($this->error);
    }
}
