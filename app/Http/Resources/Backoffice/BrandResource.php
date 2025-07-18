<?php

namespace App\Http\Resources\Backoffice;;

class BrandResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge(
            [
                'id' => $this->id,
                'name' => $this->name,
                'image' => $this->image,
                'order' => $this->order,
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
                'update' => route('bo.web.brands.edit', $this->id),
            ]),
        ]);
    }
}
