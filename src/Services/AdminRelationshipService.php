<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Database\Eloquent\Builder;
use Slowlyo\OwlAdmin\Models\AdminRelationship;

/**
 * @method AdminRelationship getModel()
 * @method AdminRelationship|Builder query()
 */
class AdminRelationshipService extends AdminService
{
    protected string $modelName = AdminRelationship::class;

    public string $cacheKey = 'admin_relationships';
}
