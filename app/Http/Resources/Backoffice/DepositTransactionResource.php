<?php

namespace App\Http\Resources\Backoffice;;

class DepositTransactionResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge(
            [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'order_id' => $this->order_id,
                'user_name' => $this->user?->name,
                'user_link' => route('bo.web.users.show', $this->user_id),
                'amount' => number_format($this->amount, 0, ',', '.') ,
                'payment_option_id' => $this->payment_option_id,
                'payment_option_name' => $this->payment_option_name,
                'order_link' => route('bo.web.orders.show', $this->order_id),
                'status' => $this->status,
                'status_name' => $this->status_name,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        );
    }

}
