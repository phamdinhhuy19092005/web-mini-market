<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class DistrictResource  extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => (string) $this->code,
            'full_name' => $this->full_name,
            'province_code' => (string) $this->province_code,
        ];
    }
}