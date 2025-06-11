<?php

namespace App\Http\Resources;

class FaqResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'answer' => $this->answer,
            'order' => $this->order,
            'faq_topic_id' => $this->faq_topic_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
