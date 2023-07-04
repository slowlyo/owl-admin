<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

class Module
{
    public static function installed()
    {
        return class_exists('Nwidart\Modules\Facades\Module');
    }
}
