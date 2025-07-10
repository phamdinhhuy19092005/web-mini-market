<?php

namespace App\Http\Resources\Backoffice;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'code' => $this->code,
            'brand_name' => optional($this->brand)->name,
            'description' => $this->description,
            'status' => $this->status,
            'status_name' => $this->status_name,
            'type' => $this->type,
            'type_name' => $this->type_name,

            'primary_image' => $this->formatImageUrl($this->primary_image) ,
            'media' => json_decode($this->media, true) ?? [],
            'suggested_relationships' => $this->suggested_relationships,

            'created_by_type' => $this->created_by_type,
            'created_by_id' => $this->created_by_id,
            'updated_by_type' => $this->updated_by_type,
            'updated_by_id' => $this->updated_by_id,

            'actions' => [
                'update' => route('bo.web.products.edit', $this->id),
                'delete' => route('bo.web.products.destroy', $this->id),
            ],

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
