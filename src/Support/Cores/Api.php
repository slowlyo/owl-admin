<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Support\Apis\DataListApi;
use Slowlyo\OwlAdmin\Support\Apis\DataCreateApi;
use Slowlyo\OwlAdmin\Support\Apis\DataDetailApi;
use Slowlyo\OwlAdmin\Support\Apis\DataDeleteApi;
use Slowlyo\OwlAdmin\Support\Apis\DataUpdateApi;

class Api
{
    public static function boot()
    {
        Admin::context()->set('apis', [
            DataListApi::class,
            DataCreateApi::class,
            DataDetailApi::class,
            DataDeleteApi::class,
            DataUpdateApi::class,
        ]);
    }
}
