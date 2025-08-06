<?php

namespace App\Http\Resources\Backoffice;

class OrderResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge([
            'id' => $this->id,
            'order_code' => $this->order_code,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'total_item' => $this->total_item,
            'total_quantity' => $this->total_quantity,
            'order_status' => $this->order_status,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ], $this->generateActionPermissions());
    }

    public function generateActionPermissions(): array
    {
        return [
            'actions' => [
                'show' => route('bo.web.orders.show', $this->id),
            ]
        ];
    }
}