<?php

namespace Slowlyo\OwlAdmin\Renderers;

use Illuminate\Support\Traits\Macroable;

/**
 * 动态方法声明（由 __call 支持）
 *
 * @method $this static($value = true)
 */
class BaseRenderer implements \JsonSerializable
{
    use Macroable {
        __call as macroCall;
    }

    public string $type;

    public array $amisSchema = [];

    public static function make(): static
    {
        return new static();
    }

    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        return $this->set($method, array_shift($parameters));
    }

    public function set($name, $value)
    {
        if ($name == 'map' && is_array($value) && array_keys($value) == array_keys(array_keys($value))) {
            $value = (object)$value;
        }

        $this->amisSchema[$name] = $value;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return $this->filteredResults();
    }

    public function toJson(): bool|string
    {
        return json_encode($this->amisSchema);
    }

    public function toArray(): array
    {
        return $this->amisSchema;
    }

    /**
     * @param string $sign         权限标识
     * @param mixed  $replaceValue 无权限时替换的值
     *
     * @return $this
     */
    public function permission(string $sign, mixed $replaceValue = '')
    {
        $this->amisSchema['owl_permission']               = $sign;
        $this->amisSchema['owl_permission_replace_value'] = $replaceValue;

        return $this;
    }

    public function filteredResults()
    {
        $permissionKey = 'owl_permission';

        if (key_exists($permissionKey, $this->amisSchema)) {
            if (!admin_user()->can($this->amisSchema[$permissionKey])) {
                return data_get($this->amisSchema, 'owl_permission_replace_value', '');
            }
        }

        return \Slowlyo\OwlAdmin\Support\Cores\AdminPipeline::handle(static::class, $this->amisSchema);
    }
}
