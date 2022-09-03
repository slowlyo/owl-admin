<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self className($value)
 * @method self x($value)
 * @method self y($value)
 * @method self w($value)
 * @method self h($value)
 * @method self data($value)
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
