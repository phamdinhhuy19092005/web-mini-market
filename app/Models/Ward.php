<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string'; 

    protected $fillable = [
        'code',
        'name',
        'name_en',
        'full_name',
        'full_name_en',
        'code_name',
        'district_code',
        'administrative_unit_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }

    public function administrativeUnit()
    {
        return $this->belongsTo(AdministrativeUnit::class);
    }
}
