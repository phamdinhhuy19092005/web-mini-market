<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\AccessChannelEnum;
use App\Enum\ActivationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'status',
        'last_logged_in_at',
        'email_verified_at',
        'password',
        'access_channel_type',
        'google_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'access_channel_type' => AccessChannelEnum::class,
        ];
    }

    public function actionLogs()
    {
        return $this->hasMany(UserActionLog::class);
    }

    public function getStatusNameAttribute(): string
    {
        return ActivationStatus::label($this->status);
    }

    public function getAccessChannelTypeNameAttribute(): string
    {
        return $this->access_channel_type?->label() ?? 'Không xác định';
    }
}
