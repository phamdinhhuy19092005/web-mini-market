<?php

namespace App\Models;

use App\Enum\ActivationStatus;
use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use Activatable;

    protected $fillable = [
        'value',
        'color',
        'attribute_id',
        'order',
        'status',
    ];


    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
