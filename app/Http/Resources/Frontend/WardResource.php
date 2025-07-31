<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class WardResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'code' => (string) $this->code,
            'full_name' => $this->full_name,
            'district_code' => (string) $this->district_code,
        ];
    }
}