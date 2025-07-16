<?php

namespace App\Http\Resources\Backoffice;

class CreatedByResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->display_name,
        ];
    }
}

