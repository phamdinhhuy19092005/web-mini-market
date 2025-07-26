<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class AttributeValueResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'attribute_id' => $this->attribute_id,
            'attribute_name' => optional($this->attribute)->name,
            'order' => $this->order,
        ];
    }
}