<?php

namespace App\Models;

use App\Enum\AccessChannelEnum;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    use Activatable;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'status',
        'last_logged_in_at',
        'email_verified_at',
        'password',
        'birthday',
        'genders',
        'allow_login',
        'access_channel_type',
        'google_id',
        'provider',
        'phone_number',
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

    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id', 'id');
    }

    public function actionLogs()
    {
        return $this->hasMany(UserActionLog::class);
    }

    public function usedCoupons()
    {
        return $this->belongsToMany(Coupon::class, 'used_coupons')->withPivot('order_id')->withTimestamps();
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }


    public function getAccessChannelTypeNameAttribute(): string
    {
        return $this->access_channel_type?->label() ?? 'Không xác định';
    }

}
