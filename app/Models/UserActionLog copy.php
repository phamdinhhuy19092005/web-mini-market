<?php

namespace App\Models;

use App\Models\Traits\HasImpactor;
use Illuminate\Database\Eloquent\Model;

class UserActionLog extends Model
{
    use HasImpactor;

    protected $fillable = [
        'user_id',
        'type',
        'reason',
        'note',
        'created_by_type',
        'created_by_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
