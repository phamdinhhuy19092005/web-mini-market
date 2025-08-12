<?php

    namespace App\Models;

    use App\Models\Traits\Activatable;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Str;

    class Cart extends Model
    {
        use Activatable;

        protected $fillable = [
            'uuid',
            'ip_address',
            'user_id',
            'currency_code',
            'address_id',
            'total_item',
            'total_quantity',
            'total_price',
            'order_id',
        ];

        protected static function boot()
        {
            parent::boot();

            static::creating(function ($cart) {
                if (empty($cart->uuid)) {
                    $cart->uuid = (string) Str::uuid();
                }
            });
        }

        public function user()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }

        public function items()
        {
            return $this->hasMany(CartItem::class, 'cart_id', 'id');
        }

    }
