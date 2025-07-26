<?php

namespace App\Http\Resources\Backoffice;;

class PostResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge(
            [
                'id' => $this->id,
                'name' => $this->name,
                'slug' => $this->slug,
                'image' => $this->image ?? " ",
                'description' => $this->description,
                'order' => $this->order,
                'post_at' => $this->post_at,
                'code' => $this->code,
                'post_category_name' => optional($this->postCategory)->name,
                'author' => $this->author,
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
                'update' => route('bo.web.posts.edit', $this->id),
            ]),
        ]);
    }
}
