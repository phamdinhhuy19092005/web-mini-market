<?php
namespace App\Models;

use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use Activatable;

    protected $fillable = [
        'cart_id',
        'inventory_id',
        'user_id',
        'note',
        'uuid',
        'currency_code',
        'has_combo',
        'quantity',
        'price',
        'total_price',
        'status',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
