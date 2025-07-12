<?php

namespace App\Http\Resources\Backoffice;

class AttributeResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'attribute_type' => $this->attribute_type,
            'attribute_type_name' => $this->attribute_type_name,
            'order' => $this->order,
            'status' => $this->status,
            'status_name' => $this->status_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'supported_categories' => $this->supported_categories,
            'supported_categories_names' => $this->categories->map(fn($item) => ['name' => $item->name]),
        ];
    }
}
