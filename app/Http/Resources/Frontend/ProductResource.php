<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;
use App\Http\Resources\Frontend\BrandResource;
use App\Http\Resources\Frontend\InventoryResource; 

class ProductResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'code' => $this->code,
            'description' => $this->description,
            'primary_image' => $this->primary_image,
            'media' => json_decode($this->media, true) ?? [],
            'brand' => $this->whenLoaded('brand', function () {
                return new BrandResource($this->brand); 
            }),
            'inventories' => $this->whenLoaded('inventories', function () {
                return InventoryResource::collection($this->inventories);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}