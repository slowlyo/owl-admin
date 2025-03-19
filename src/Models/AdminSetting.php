<?php

namespace Slowlyo\OwlAdmin\Models;

class AdminSetting extends BaseModel
{
    protected $table = 'admin_settings';

    protected $primaryKey = 'key';

    protected $guarded = [];

    protected $casts = [
        'values' => 'json',
    ];

    protected function asJson($value, $flags = 0)
    {
        return json_encode($value, $flags == 0 ? JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES : $flags);
    }
}
