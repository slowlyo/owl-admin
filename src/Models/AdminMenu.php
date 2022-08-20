<?php

namespace Slowlyo\SlowAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminMenu extends Model
{
    const TYPE_ROUTE = 1;
    const TYPE_LINK  = 2;

    public static function getType(): array
    {
        return [
            self::TYPE_ROUTE => '路由',
            self::TYPE_LINK  => '外链',
        ];
    }

    /**
     * 父级菜单
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
