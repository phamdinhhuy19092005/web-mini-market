<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class AttributeResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'attribute_type' => $this->attribute_type,
            'order' => $this->order,
            'supported_categories' => $this->supported_categories ?? " ",
            'supported_categories_names' => $this->categories->pluck('name')->toArray(),

        ];
    }
}