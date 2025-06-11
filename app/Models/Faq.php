<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FaqTopic; // Thêm dòng này nếu có model FaqTopic

class Faq extends Model
{
    protected $table = 'faqs';

    protected $fillable = [
        'question',
        'answer',
        'order',
        'status',
        'faq_topic_id',
    ];

    public function topic()
    {
        return $this->belongsTo(FaqTopic::class, 'faq_topic_id');
    }
}
