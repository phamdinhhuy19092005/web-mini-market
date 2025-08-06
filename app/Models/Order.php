<?php

namespace App\Models;

use App\Enum\OrderStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_code',
        'uuid',
        'user_id',
        'currency_code',
        'fullname',
        'email',
        'phone',
        'company',
        'country_code',
        'address_line',
        'city_name',
        'postal_code',
        'shipping_rate_id',
        'payment_option_id',
        'deposit_transaction_id',
        'total_item',
        'total_quantity',
        'taxrate',
        'shipping_weight',
        'total_price',
        'taxes',
        'coupon_id',
        'promotion_id',
        'grand_total',
        'shipping_date',
        'delivery_date',
        'payment_status',
        'order_status',
        'is_sent_invoice_to_user',
        'admin_note',
        'user_note',
        'retry_order_times',
        'created_by_id',
        'created_by_type',
        'updated_by_id',
        'updated_by_type',
        'log',
        'order_channel',
    ];

    protected $casts = [
        'order_channel' => 'array',
        'status' => OrderStatusEnum::class,
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingRate()
    {
        return $this->belongsTo(ShippingRate::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function paymentOption()
    {
        return $this->belongsTo(PaymentOption::class);
    }

    public function depositTransaction()
    {
        return $this->belongsTo(DepositTransaction::class, 'deposit_transaction_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function usedCoupons()
    {
        return $this->hasMany(UsedCoupon::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'order_id');
    }

    public function createdBy()
    {
        return $this->morphTo('created_by');
    }

    public function updatedBy()
    {
        return $this->morphTo('updated_by');
    }
}
