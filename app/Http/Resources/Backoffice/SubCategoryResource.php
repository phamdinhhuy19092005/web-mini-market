<?php

namespace App\Http\Resources\Backoffice;;

    class SubCategoryResource extends BaseResource
    {
        public function toArray($request): array
        {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'category_name' => optional($this->category)->name,
                'category_id' => $this->category_id,
                'slug' => $this->slug,
                'image' => $this->image,
                'description' => $this->description,
                'status' => $this->status,
                'status_name' => $this->status_name,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        }
    }
