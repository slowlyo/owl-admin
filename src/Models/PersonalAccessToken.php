<?php

namespace Slowlyo\OwlAdmin\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Slowlyo\OwlAdmin\Admin;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    public function __construct(array $attributes = [])
    {
        $this->setConnection(Admin::config('admin.database.connection'));

        parent::__construct($attributes);
    }
}
