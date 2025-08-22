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
        'retry_order_times',
        'phone',
        'company',
        'country_code',
        'address_line',
        'city_name',
        'shipping_rate_id',
        'payment_option_id',
        'deposit_transaction_id',
        'coupon_id',
        'total_item',
        'total_quantity',
        'shipping_weight',
        'total_price',
        'grand_total',
        'shipping_date',
        'delivery_date',
        'payment_status',
        'order_status',
        'admin_note',
        'user_note',
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

    public function getGrandTotalFormattedAttribute()
    {
        return number_format($this->grand_total, 0, ',', '.') . '₫';
    }

    public function getOrderStatusNameAttribute(): string
    {
        return OrderStatusEnum::findConstantLabelVn($this->order_status);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingOption()
    {
        return $this->belongsTo(ShippingOption::class, 'shipping_rate_id');
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

    public function usedDiscounts()
    {
        return $this->hasMany(usedDiscount::class);
    }

    public function discounts()
    {
        return $this->hasMany(OrderDiscount::class, 'order_id');
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

    /**
     * Kiểm tra xem đơn hàng có thể chuyển trạng thái "Vận chuyển" không
     */
    public function canDelivery(): bool
    {
        return $this->order_status === OrderStatusEnum::PROCESSING;
    }

    /**
     * Kiểm tra xem đơn hàng có thể chuyển trạng thái "Hoàn thành" không
     */
    public function canComplete(): bool
    {
        return $this->order_status === OrderStatusEnum::DELIVERY;
    }

    /**
     * Kiểm tra xem đơn hàng có thể hủy không
     */
    public function canCancel(): bool
    {
        return in_array($this->order_status, [
            OrderStatusEnum::WAITING_FOR_PAYMENT,
            OrderStatusEnum::PROCESSING
        ]);
    }

    /**
     * Kiểm tra xem đơn hàng có thể hoàn tiền không
     */
    public function canRefund(): bool
    {
        return $this->order_status === OrderStatusEnum::COMPLETED;
    }

    public function canProcessing(): bool
    {
        return $this->order_status === OrderStatusEnum::WAITING_FOR_PAYMENT;
    }


}
