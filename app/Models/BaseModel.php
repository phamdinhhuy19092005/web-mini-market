<?php

namespace App\Models;

use App\Exceptions\ModelNotFoundException;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    public static function getMorphProperty($name, Model $model = null)
    {
        if (! $model) {
            return [
                "{$name}_type" => null,
                "{$name}_id" => null,
            ];
        }

        return [
            "{$name}_type" => Model::getActualClassNameForMorph(get_class($model)),
            "{$name}_id" => $model->getKey(),
        ];
    }
}