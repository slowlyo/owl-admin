<?php

namespace Slowlyo\OwlAdmin\Renderers;

class BaseRenderer implements \JsonSerializable
{
    public string $type;

    public array $amisSchema = [];

    public static function make(): static
    {
        return new static();
    }

    public function __call($name, $arguments)
    {
        return $this->set($name, array_shift($arguments));
    }

    public function set($name, $value)
    {
        $this->amisSchema[$name] = $value;

        return $this;
    }

    public function jsonSerialize()
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

        return $this->amisSchema;
    }
}
