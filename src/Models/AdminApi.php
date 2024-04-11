<?php

namespace Slowlyo\OwlAdmin\Models;

use Slowlyo\OwlAdmin\Support\Apis\AdminBaseApi;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class AdminApi extends BaseModel
{
    use HasTimestamps;

    protected $appends = ['template_title', 'method'];

    protected $casts = [
        'args' => 'json',
    ];

    const METHODS = ['get', 'head', 'post', 'put', 'patch', 'delete', 'options'];

    public function templateTitle(): Attribute
    {
        return Attribute::get(function () {
            if (!(new \ReflectionClass($this->template))->isSubclassOf(AdminBaseApi::class)) {
                return '';
            }

            $api = app($this->template);

            $title = $api->getTitle();

            if ($title) {
                $title = $api->getMethod() . ' - ' . $title;
            }

            return $title;
        });
    }

    public function method(): Attribute
    {
        return Attribute::get(function () {
            if (!(new \ReflectionClass($this->template))->isSubclassOf(AdminBaseApi::class)) {
                return 'any';
            }

            $method = app($this->template)->getMethod();

            return in_array($method, self::METHODS) ? $method : 'any';
        });
    }
}
