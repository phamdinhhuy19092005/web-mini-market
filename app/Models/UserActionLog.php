<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActionLog extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'reason',
        'created_by_id',
        'created_by_type',
        'updated_by_id',
        'updated_by_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy()
    {
        return $this->morphTo();
    }

    public function updatedBy()
    {
        return $this->morphTo();
    }
}
