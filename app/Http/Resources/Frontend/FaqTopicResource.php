<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class FaqTopicResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'order' => $this->order,
        ];
    }
}