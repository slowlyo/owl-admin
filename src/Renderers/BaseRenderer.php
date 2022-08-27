<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method className($value)
 * @method x($value)
 * @method y($value)
 * @method w($value)
 * @method h($value)
 * @method data($value)
 */
class BaseRenderer implements \JsonSerializable
{
    public string $type;

    public static function make(): static
    {
        return new static();
    }

    public function __call($name, $arguments)
    {
        $this->$name = array_shift($arguments);

        return $this;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function toJson(): bool|string
    {
        return json_encode($this);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
