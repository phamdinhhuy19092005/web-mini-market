<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativeRegion extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'code_name',
        'code_name_en',
    ];

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }
}

