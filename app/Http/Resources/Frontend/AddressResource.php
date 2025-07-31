<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class AddressResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
                'user' => [
                    'id' => $this->user_id,
                ],
                'name' => $this->name,
                'phone' => $this->phone,
                'address_line' => $this->address_line,

                'province' => [
                    'code' => $this->province_code,
                    'name' => optional($this->province)->name,
                ],
                'district' => [
                    'code' => $this->district_code,
                    'name' => optional($this->district)->name,
                ],
                'ward' => [
                    'code' => $this->ward_code,
                    'name' => optional($this->ward)->name,
                ],

                'is_default' => $this->is_default ? true : false,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
        ];
    }
}