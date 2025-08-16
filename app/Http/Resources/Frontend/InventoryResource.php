<?php
namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class InventoryResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'product' => [
                'id' => $this->product_id,
                'code' => $this->product?->code,
                'name' => $this->product?->name,
            ],
            'condition' => $this->condition,
            'condition_note' => $this->condition_note,
            'unit' => $this->unit ?: null,
            'unit_price' => $this->unit_price ? number_format($this->unit_price, 0, '.', ',') . '₫' : 'N/A',
            'quantity_in_unit' => $this->quantity_in_unit ?? 1,
            'description',
            'slug' => $this->slug,
            'sku' => $this->sku,
            'status' => $this->status,
            'status_name' => $this->status_name,
            'key_features' => $this->key_features,
            'purchase_price' => $this->purchase_price ? number_format($this->purchase_price, 0, '.', ',') . '₫' : 'N/A',
            'sale_price' => $this->sale_price ? number_format($this->sale_price, 0, '.', ',') . '₫' : 'N/A',
            'offer_price' => $this->offer_price,
            'stock_quantity' => $this->stock_quantity,
            'min_order_quantity' => $this->min_order_quantity,
            'available_from' => $this->available_from,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'image' => $this->image,
            'init_sold_count' => $this->init_sold_count ?? 0,
            'sold_count' => $this->sold_count ?? 0,
            'description' => $this->description,
            'created_at' => $this->created_at,  
            'updated_at' => $this->updated_at,
        ];
    }
}
