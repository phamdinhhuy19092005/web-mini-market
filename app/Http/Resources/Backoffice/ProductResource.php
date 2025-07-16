<?php

namespace App\Http\Resources\Backoffice;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge([
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'code' => $this->code,
            'brand_id' => $this->brand_id,
            'description' => $this->description,
            'status' => $this->status,
            'status_name' => $this->status_name,
            'type' => $this->type,
            'type_name' => $this->type_name,

            'primary_image' => $this->primary_image,
            'media' => json_decode($this->media, true) ?? [],
            'suggested_relationships' => $this->suggested_relationships,

            // 'attributes' => $this->whenLoaded('attributes'),

            // 'attributes' => AttributeResource::collection($this->attributes), // nếu có
            // 'inventories' => InventoryResource::collection($this->inventories),
            // 'suggested_relationships' => ProductRelationResource::collection($this->suggestedProducts),
            'brand' => $this->whenLoaded('brand', function() {
                return new BrandResource($this->brand);
            }),
            'created_by' => $this->whenLoaded('createdBy', function() {
                return new CreatedByResource($this->createdBy);
            }),
            'updated_by' => $this->whenLoaded('updatedBy', function() {
                return new UpdatedByResource($this->updatedBy);
            }),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ], $this->generateActionPermissions());
    }

    public function generateActionPermissions() : array
    {
        return array_filter([
            'actions' => array_filter([
                'update' => route('bo.web.products.edit', $this->id),
                'delete' => route('bo.web.products.destroy', $this->id),
            ]),
        ]);
    }
}
