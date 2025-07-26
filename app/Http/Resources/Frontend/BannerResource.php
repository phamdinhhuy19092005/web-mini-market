<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

class BannerResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'label' => $this->label,
            'type' => $this->type,
            'cta_label' => $this->cta_label,
            'redirect_url' => $this->redirect_url,
            'color' => $this->color,
            'desktop_image' => $this->desktop_image,
            'mobile_image' => $this->mobile_image,
            'description' => $this->description,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
        ];
    }
}