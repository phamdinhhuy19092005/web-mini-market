<?php

namespace App\Http\Resources\Backoffice;

use App\Enum\ShippingRateTypeEnum;

;

class ShippingRateResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'delivery_takes' => $this->delivery_takes,
            'shipping_zone_id' => $this->shipping_zone_id,
            'type_name' => ShippingRateTypeEnum::getName($this->type),
            'minimum' => $this->minimum,
            'maximum' => $this->maximum,
            'rate' => $this->rate,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
