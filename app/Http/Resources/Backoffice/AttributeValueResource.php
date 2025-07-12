<?php

namespace App\Http\Resources\Backoffice;

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
            'status' => $this->status,
            'status_name' => $this->status_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
