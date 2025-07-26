<?php

namespace App\Http\Resources\Backoffice;;

class FaqResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge(
            [
                'id' => $this->id,
                'question' => $this->question,
                'answer' => $this->answer,
                'order' => $this->order,
                'faq_topic_id' => $this->faq_topic_id,
                'faq_topic_name' => optional($this->faq_topic)->name,
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
                'update' => route('bo.web.faq-topics.edit', $this->id),
            ]),
        ]);
    }
}
