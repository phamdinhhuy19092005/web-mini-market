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
                'amount' => number_format($this->amount, 0, ',', '.') ,
                'payment_option_id' => $this->payment_option_id,
                'status' => $this->status,
                'status_name' => $this->status_name,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ], $this->generateActionPermissions()
        );
    }

    public function generateActionPermissions() : array
    {
        return array_filter([
            'actions' => array_filter([
                'update' => route('bo.web.categories.edit', $this->id),
            ]),
        ]);
    }
}
