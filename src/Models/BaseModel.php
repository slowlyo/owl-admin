<?php

namespace Slowlyo\OwlAdmin\Models;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Database\Eloquent\Model;
use Slowlyo\OwlAdmin\Traits\DatetimeFormatterTrait;

class BaseModel extends Model
{
    use DatetimeFormatterTrait;

    public function __construct(array $attributes = [])
    {
        if(!isset($this->connection)){
            $this->setConnection(Admin::config('admin.database.connection'));
        }

        parent::__construct($attributes);
    }
}
