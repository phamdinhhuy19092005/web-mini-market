<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

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
            'status' => $this->status,
            'post_at' => $this->post_at,
        ];
    }
}
