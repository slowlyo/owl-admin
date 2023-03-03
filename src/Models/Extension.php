<?php

namespace Slowlyo\OwlAdmin\Models;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    protected $fillable = ['name', 'is_enabled', 'options'];

    protected $casts = [
        'options' => 'json',
    ];

    protected $table = 'admin_extensions';
}
