<?php

namespace Slowlyo\OwlAdmin\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class AdminRelationship extends BaseModel
{
    use HasTimestamps;

    protected $casts = [
        'args'  => 'json',
        'extra' => 'json',
    ];

    /** @var string 一对一 */
    const TYPE_HAS_ONE = 'HAS_ONE';

    /** @var string 一对多 */
    const TYPE_HAS_MANY = 'HAS_MANY';

    /** @var string 一对多(反向)/属于 */
    const TYPE_BELONGS_TO = 'BELONGS_TO';

    /** @var string 多对多 */
    const TYPE_BELONGS_TO_MANY = 'BELONGS_TO_MANY';

    /** @var string 远程一对一 */
    const TYPE_HAS_ONE_THROUGH = 'HAS_ONE_THROUGH';

    /** @var string 远程一对多 */
    const TYPE_HAS_MANY_THROUGH = 'HAS_MANY_THROUGH';

    /** @var string 一对一(多态) */
    const TYPE_MORPH_ONE = 'MORPH_ONE';

    /** @var string 一对多(多态) */
    const TYPE_MORPH_MANY = 'MORPH_MANY';

    /** @var string 多对多(多态) */
    const TYPE_MORPH_TO_MANY = 'MORPH_TO_MANY';

    const TYPE_MAP = [
        self::TYPE_HAS_ONE          => 'hasOne',
        self::TYPE_HAS_MANY         => 'hasMany',
        self::TYPE_BELONGS_TO       => 'belongsTo',
        self::TYPE_BELONGS_TO_MANY  => 'belongsToMany',
        self::TYPE_HAS_ONE_THROUGH  => 'hasOneThrough',
        self::TYPE_HAS_MANY_THROUGH => 'hasManyThrough',
        self::TYPE_MORPH_ONE        => 'morphOne',
        self::TYPE_MORPH_MANY       => 'morphMany',
        self::TYPE_MORPH_TO_MANY    => 'morphToMany',
    ];

    const TYPE_LABEL_MAP = [
        self::TYPE_HAS_ONE          => '一对一',
        self::TYPE_HAS_MANY         => '一对多',
        self::TYPE_BELONGS_TO       => '一对多(反向)/属于',
        self::TYPE_BELONGS_TO_MANY  => '多对多',
        self::TYPE_HAS_ONE_THROUGH  => '远程一对一',
        self::TYPE_HAS_MANY_THROUGH => '远程一对多',
        self::TYPE_MORPH_ONE        => '一对一(多态)',
        self::TYPE_MORPH_MANY       => '一对多(多态)',
        self::TYPE_MORPH_TO_MANY    => '多对多(多态)',
    ];

    public function aaa()
    {
        // $this->belongsTo();
    }

    public static function typeOptions()
    {
        return collect(self::TYPE_MAP)->map(function ($item, $index) {
            return [
                'label'  => self::TYPE_LABEL_MAP[$index],
                'method' => $item,
                'value'  => $index,
            ];
        })->values();
    }
}
