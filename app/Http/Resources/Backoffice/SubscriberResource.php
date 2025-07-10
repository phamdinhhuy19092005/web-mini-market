<?php

namespace App\Http\Resources\Backoffice;

use App\Enum\SubscriberTypeEnum;

;

class SubscriberResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'type_name' => SubscriberTypeEnum::getName($this->type),
            'sent_post' => $this->sent_post,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
