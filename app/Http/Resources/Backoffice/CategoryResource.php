<?php

namespace App\Http\Resources\Backoffice;;

class CategoryResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_group_name' => optional($this->categoryGroup)->name,
            'category_group_id' => $this->category_group_id,
            'slug' => $this->slug,
            'image' => $this->formatImageUrl($this->image),
            'description' => $this->description,
            'status' => $this->status,
            'status_name' => $this->status_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'actions' => [
                'update' => route('bo.web.categories.edit', $this->id),
                'delete' => route('bo.web.categories.destroy', $this->id),
            ],
        ];
    }
}
