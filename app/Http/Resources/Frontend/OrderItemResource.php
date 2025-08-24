<?php
namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class OrderItemResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'price' => $this->price ? number_format($this->price, 0, '.', ',') : '',
            'total_price' => $this->total_price ? number_format($this->total_price, 0, '.', ',') : '',
            'inventory' => [
                'id' => $this->inventory_id,
                'title' => $this->inventory?->title ?? '',
                'image' => $this->inventory?->image ?? '', 
            ],
            'product' => [
    'id' => $this->inventory?->product?->id ?? null,
    'name' => $this->inventory?->product?->name ?? '',
    'code' => $this->inventory?->product?->code ?? '',
],

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
