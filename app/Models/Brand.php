<?php

namespace App\Models;

use App\Enum\ActivationStatus;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'name',
        'image',
        'order',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

     public function getStatusNameAttribute(): string
    {
        return ActivationStatus::label($this->status);
    }

}
