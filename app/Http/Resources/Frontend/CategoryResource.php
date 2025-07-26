<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

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
            'image' => $this->image,
            'description' => $this->description,
            'subcategories' => $this->subcategories->map(function ($subcategory) {
                return [
                    'id' => $subcategory->id,
                    'name' => $subcategory->name,
                    'slug' => $subcategory->slug,
                ];
            }),
        ];
    }
}