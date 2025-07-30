<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class CategoryResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'subcategories' => SubCategoryResource::collection(
                $this->whenLoaded('subcategoriesWithProducts')
            )
        ];
    }
}
