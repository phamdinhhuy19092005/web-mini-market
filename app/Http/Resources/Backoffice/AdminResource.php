<?php

namespace App\Http\Resources\Backoffice;;

class AdminResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge(
            [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ], $this->generateActionPermissions()
        );
    }

    public function generateActionPermissions() : array
    {
        return array_filter([
            'actions' => array_filter([
                'update' => route('bo.web.admins.edit', $this->id),
            ]),
        ]);
    }
}
