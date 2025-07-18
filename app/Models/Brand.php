<?php

namespace App\Models;

use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Activatable;
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

}
