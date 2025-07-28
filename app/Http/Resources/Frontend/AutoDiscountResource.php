<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class AutoDiscountResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
            'discount_type' => $this->discount_type,
            'discount_type_name' => $this->discount_type_name,
            'discount_value' => $this->discount_value,
            'condition_type' => $this->condition_type,
            'condition_value' => $this->condition_value,
            'discount_condition_type_name' => $this->discount_condition_type_name,
            'usage_limit' => $this->usage_limit ?? 'Không giới hạn',
            'used' => $this->used_coupons_count ?? 0,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'terms' => $this->terms,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}