<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Backoffice\BaseResource;

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
            'faq_topic_name' => optional($this->faq_topic)->name,
        ];
    }
}