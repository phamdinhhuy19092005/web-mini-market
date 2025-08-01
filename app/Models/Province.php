<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'code',
        'name',
        'name_en',
        'full_name',
        'full_name_en',
        'code_name',
        'administrative_unit_id',
        'administrative_region_id',
    ];

   
    public function administrativeUnit()
    {
        return $this->belongsTo(AdministrativeUnit::class);
    }

    public function administrativeRegion()
    {
        return $this->belongsTo(AdministrativeRegion::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class, 'province_code', 'code');
    }
}
