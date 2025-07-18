<?php

namespace App\Http\Resources\Backoffice;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

abstract class BaseResource extends JsonResource
{
    /**
     * Create a new pagination resource collection.
     *
     * @param mixed $resource
     *
     * @return BasePaginationResource
     */
    public static function pagination($resource, $meta = [])
    {
        return tap(new BasePaginationResource($resource, static::class, $meta), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        });
    }
}
