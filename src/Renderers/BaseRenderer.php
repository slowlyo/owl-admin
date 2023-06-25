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

    public function permission($permission)
    {
        $this->amisSchema['owl_permission'] = $permission;

        return $this;
    }

    public function filteredResults()
    {
        $permissionKey = 'owl_permission';

        if (key_exists($permissionKey, $this->amisSchema)) {
            if (!admin_user()->can($this->amisSchema[$permissionKey])) {
                return null;
            }
        }

        return $this->amisSchema;
    }
}
