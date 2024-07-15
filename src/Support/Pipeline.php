<?php

namespace Slowlyo\OwlAdmin\Support;

use Illuminate\Support\Traits\Conditionable;

/**
 * 适配 laravel 9
 */
class Pipeline extends \Illuminate\Pipeline\Pipeline
{
    use Conditionable;

    /**
     * @param $passable
     *
     * @return self
     */
    public static function handle($passable)
    {
        return app(self::class)->send($passable);
    }
}
