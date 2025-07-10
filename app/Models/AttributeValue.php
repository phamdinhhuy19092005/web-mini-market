<?php

namespace App\Models;

use App\Enum\ActivationStatus;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'attribute_values';

    protected $fillable = [
        'value',
        'color',
        'attribute_id',
        'order',
        'status',
    ];

    public function getStatusNameAttribute(): string
    {
        return ActivationStatus::label($this->status);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
