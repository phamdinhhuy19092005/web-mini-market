<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class PaymentResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'transaction_id' => $this->transaction_id,
            'payment_method' => $this->payment_method,
        ];
    }
}