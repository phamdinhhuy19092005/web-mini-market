<?php

namespace App\Http\Resources\Backoffice;;

class PageResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge(
            [
                'id' => $this->id,
                'name' => $this->name,
                'slug' => $this->slug,
                'title' => $this->title,
                'description' => $this->description,
                'order' => $this->order,
                'code' => $this->code,
                'display_in' => $this->display_in,
                'status' => $this->status,
                'status_name' => $this->status_name,
                'post_at' => $this->post_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ], $this->generateActionPermissions()
        );
    }

    public function generateActionPermissions(): array
    {
        return [
            'actions' => [
                'show' => route('bo.web.pages.show', $this->id),
            ]
        ];
    }
}
