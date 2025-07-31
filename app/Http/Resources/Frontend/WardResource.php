<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class WardResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'code' => $this->code,
            'full_name' => $this->full_name,
            'district_code' => $this->district_code,
        ];
    }
}