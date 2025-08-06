<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'slug' => $this->slug,
            'category' => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
                'category_group' => [
                    'id'   => $this->category->categoryGroup->id ?? null,
                    'name' => $this->category->categoryGroup->name ?? null,
                    'slug' => $this->category->categoryGroup->slug ?? null,
                ]
            ]
        ];
    }
}

