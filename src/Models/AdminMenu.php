<?php

namespace Slowlyo\OwlAdmin\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminMenu extends BaseModel
{
    protected $guarded = [];

    const TYPE_ROUTE = 1;
    const TYPE_LINK  = 2;

    public static function getType(): array
    {
        return [
            self::TYPE_ROUTE => __('admin.admin_menu.route'),
            self::TYPE_LINK  => __('admin.admin_menu.link'),
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

    public function title(): Attribute
    {
        return Attribute::get(function ($value){
            return __("menu.{$value}") == "menu.{$value}" ? $value : __("menu.{$value}");
        });
    }

    public function permissions()
    {
        return $this->hasMany(AdminPermission::class, 'menu_id');
    }
}
