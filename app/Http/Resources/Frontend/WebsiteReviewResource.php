<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class WebsiteReviewResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_name' => optional($this->user)->name,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'created_at' => $this->created_at,
        ];
    }
}