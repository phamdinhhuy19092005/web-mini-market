<?php

namespace App\Http\Resources\Backoffice;;

class AutoDiscountResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge(
            [
                'id' => $this->id,
                'title' => $this->title,
                'code' => $this->code,
                'discount_type' => $this->discount_type,
                'discount_type_name' => $this->discount_type_name,
                'discount_value' => $this->discount_value,
                'condition_type' => $this->condition_type, 
                'condition_value' => $this->condition_value,
                'usage_limit' => $this->usage_limit ?? 'Không giới hạn',
                'used' => $this->used_coupons_count ?? 0,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'terms' => $this->terms,
                'status' => $this->status,
                'status_name' => $this->status_name,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ], $this->generateActionPermissions()
        );
    }

    public function generateActionPermissions() : array
    {
        return array_filter([
            'actions' => array_filter([
                'update' => route('bo.web.auto-discounts.edit', $this->id),
            ]),
        ]);
    }
}
