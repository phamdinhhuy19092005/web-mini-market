<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FaqTopic; // Thêm dòng này nếu có model FaqTopic
use App\Models\Traits\Activatable;

class Faq extends Model
{
    use Activatable;

    protected $fillable = [
        'question',
        'answer',
        'order',
        'status',
        'faq_topic_id',
    ];

    public function faq_topic()
    {
        return $this->belongsTo(FaqTopic::class, 'faq_topic_id');
    }
}
