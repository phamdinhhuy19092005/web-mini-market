<?php

namespace App\Http\Resources\Backoffice;

class BannerResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge(
            [
                'id' => $this->id,
                'name' => $this->name,
                'label' => $this->label,
                'type' => $this->type,
                'cta_label' => $this->cta_label,
                'redirect_url' => $this->redirect_url,
                'order' => $this->order,
                'color' => $this->color,
                'desktop_image' => $this->desktop_image,
                'mobile_image' => $this->mobile_image,
                'description' => $this->description,
                'start_at' => $this->start_at,
                'end_at' => $this->end_at,
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
                'update' => route('bo.web.banners.edit', $this->id),
            ]),
        ]);
    }
}
