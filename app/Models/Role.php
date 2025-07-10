<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends SpatieRole
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
    ];

    public function admins()
    {
        return $this->belongsToMany(\App\Models\Admin::class, 'model_has_roles', 'role_id', 'model_id')
                    ->where('model_type', \App\Models\Admin::class);
    }
}
