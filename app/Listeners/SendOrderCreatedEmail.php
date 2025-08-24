<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderCreatedMail;
use Illuminate\Support\Facades\Mail;

class SendOrderCreatedEmail
{
    public function handle(OrderCreated $event): void
    {
        // Lấy order từ event
        $order = $event->order;

        // Gửi mail tới khách hàng
        Mail::to($order->email)->queue(new OrderCreatedMail($order));
    }
}
