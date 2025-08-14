<?php

namespace App\Http\Resources\Backoffice;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge([
            'id' => $this->id,
            'user_name' => optional($this->user)->name,
            'total_item' => $this->total_item, 
            'ip_address' => $this->ip_address,
            'uuid' => $this->uuid,
            'address_id' => $this->address_id,
            'currency_code' => $this->currency_code,
            'total_quantity' => $this->total_quantity,
            'total_price' => $this->total_price ? number_format($this->total_price, 0, '.', ',') : '',
            'order_id' => $this->order_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ], $this->generateActionPermissions());
    }

    public function generateActionPermissions(): array
    {
        return array_filter([
            'actions' => array_filter([
                'show' => route('bo.web.carts.show', $this->id),
            ]),
        ]);
    }
}
