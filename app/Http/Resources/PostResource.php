<?php

namespace App\Http\Resources;

class PostResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
            'description' => $this->description,
            'order' => $this->order,
            'code' => $this->code,
            'post_category_id' => $this->post_category_id,
            'author' => $this->author,
            'display_on_frontend' => $this->display_on_frontend,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
