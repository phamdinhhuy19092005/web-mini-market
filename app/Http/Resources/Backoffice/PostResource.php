<?php

namespace App\Http\Resources\Backoffice;;

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
            'post_at' => $this->post_at,
            'code' => $this->code,
            'post_category_name' => optional($this->postCategory)->name,
            'author' => $this->author,
            'display_on_frontend' => $this->display_on_frontend,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
