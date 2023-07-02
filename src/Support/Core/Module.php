<?php

namespace Slowlyo\OwlAdmin\Support\Core;

class Module
{
    public static function installed()
    {
        return class_exists('Nwidart\Modules\Facades\Module');
    }
}
