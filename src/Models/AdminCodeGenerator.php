<?php

namespace Slowlyo\OwlAdmin\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class AdminCodeGenerator extends BaseModel
{
    use HasTimestamps;

    protected $casts = [
        'columns'   => 'array',
        'needs'     => 'array',
        'menu_info' => 'array',
    ];
}
