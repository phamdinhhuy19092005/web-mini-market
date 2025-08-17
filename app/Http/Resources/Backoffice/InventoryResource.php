<?php

namespace App\Http\Resources\Backoffice;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge(
            [
                'id' => $this->id,
                'title' => $this->title,
                'product_id' => $this->product_id,
                'product' => [
                    'code' => $this->product ? $this->product->code : null,
                ],
                'condition' => $this->condition,
                'condition_note' => $this->condition_note,
                'unit' => $this->unit ?: null,
                'unit_type' => $this->unit_type ?: null,
                'slug' => $this->slug,
                'sku' => $this->sku,
                'status' => $this->status,
                'status_name' => $this->status_name,
                'key_features' => $this->key_features,
                'purchase_price' => $this->purchase_price ? number_format($this->purchase_price, 0, '.', ',') . '₫' : '',
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
                'display_on_frontend_name' => $this->display_on_frontend ? 'Active' : 'Inactive',
                'allow_frontend_search_name' => $this->allow_frontend_search ? 'Active' : 'Inactive',
                'created_by_type' => $this->created_by_type,
                'created_by_id' => $this->created_by_id,
                'created_by' => [
                    'name' => $this->createdBy ? $this->createdBy->name : null,
                ],
                'updated_by_type' => $this->updated_by_type,
                'updated_by_id' => $this->updated_by_id,
                'updated_by' => [
                    'name' => $this->updatedBy ? $this->updatedBy->name : null,
                ],
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ], $this->generateActionPermissions()
        );
    }

    public function generateActionPermissions() : array
    {
        return array_filter([
            'actions' => array_filter([
                'update' => route('bo.web.inventories.edit', $this->id),
            ]),
        ]);
    }
}


