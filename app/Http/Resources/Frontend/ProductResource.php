<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;
use App\Http\Resources\Frontend\BrandResource;
use App\Http\Resources\Frontend\InventoryResource;
use App\Http\Resources\Frontend\SubCategoryResource;

class ProductResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'code' => $this->code,
            // 'description' => $this->description,
            'primary_image' => $this->primary_image,
            'media' => json_decode($this->media, true) ?? [],
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'subcategories' => SubCategoryResource::collection($this->whenLoaded('subcategories')),
            'inventories' => InventoryResource::collection($this->whenLoaded('inventories')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
