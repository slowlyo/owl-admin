<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Services\AdminRelationshipService;

class Relationships
{
    public static function boot()
    {
        $relationships = AdminRelationshipService::make()->getAll();

        if (blank($relationships)) {
            return;
        }

        foreach ($relationships as $relationship) {
            try {
                $relationship->model::resolveRelationUsing($relationship->title, function ($model) use ($relationship) {
                    $method = $relationship->method;

                    return $model->$method(...array_column($relationship->buildArgs(), 'value'));
                });
            } catch (\Throwable $e) {
            }
        }
    }
}
