<?php

namespace App\Http\Resources\Backoffice;;

class UserResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
            'status_name' => $this->status_name,
            'last_logged_in_at' => $this->last_logged_in_at,
            'access_channel_type' => $this->access_channel_type,
            'access_channel_type_name' => $this->access_channel_type_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'actions' => [
                'show' => route('bo.web.users.show', $this->id),
            ]
        ];
    }
}
