<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class CouponResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
            'discount_type' => $this->discount_type,
            'discount_value' => $this->discount_value,
            'usage_limit' => $this->usage_limit ?? 'Không giới hạn',
            'used' => $this->used_coupons_count ?? 0,
            'start_date' => $this->start_date ?? 'Không thời hạn',
            'end_date' => $this->end_date ?? 'Không thời hạn',
            'terms' => $this->terms,
        ];
    }
}