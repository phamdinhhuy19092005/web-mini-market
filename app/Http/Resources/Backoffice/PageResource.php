<?php

namespace App\Http\Resources\Backoffice;;

class PageResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'order' => $this->order,
            'code' => $this->code,
            'display_in' => $this->display_in,
            'author' => $this->author,
            'display_on_frontend' => $this->display_on_frontend,
            'status' => $this->status,
            'post_at' => $this->post_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
