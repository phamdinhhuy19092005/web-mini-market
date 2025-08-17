<?php

namespace App\Http\Resources\Backoffice;;

class WebsiteReviewResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge(
            [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'user' => $this->whenLoaded('user', fn() => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                ]),

                'rating' => $this->rating,
                'comment' => $this->comment,
                'status' => $this->status,
                'status_name' => $this->status_name,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ], $this->generateActionPermissions()
        );
    }

    public function generateActionPermissions() : array
    {
        return array_filter([
            'actions' => array_filter([
                'update' => route('bo.web.website-reviews.edit', $this->id),
            ]),
        ]);
    }
}
