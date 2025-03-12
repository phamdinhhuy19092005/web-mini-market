<?php

namespace App\Models;

use App\Models\BaseAuthenticateModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Admin extends BaseAuthenticateModel
{
    //
    use HasFactory;
    use SoftDeletes;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        // 'password' => Hash::class,
    ];
}
