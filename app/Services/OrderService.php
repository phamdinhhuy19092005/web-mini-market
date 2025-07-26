<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\PaymentOption;
use Illuminate\Support\Str;

class OrderService extends BaseService
{
    public function __construct(public DepositService $depositService) {}

    public function orderByAdmin($data = [])
    {
        $user = User::find(1);
        $paymentOption = PaymentOption::find($data['payment_option_id'] ?? null);

        $order = Order::create([
            'order_code' => 'ORD' . time(),
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'currency_code' => 'VND',
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country_code' => 'VND',
            'address_line' => $data['address_line'] ?? '',
        ]);

        $this->depositService->deposit(
            $user,
            $data['grand_total'] ?? 100000,
            $paymentOption,
            $user,
            array_merge($data, ['order_id' => $order->id])
        );

        return $order;
    }
}
