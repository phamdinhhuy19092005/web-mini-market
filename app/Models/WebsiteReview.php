<?php

namespace App\Models;

use App\Enum\ReviewStatusEnum;
use Illuminate\Database\Eloquent\Model;

class WebsiteReview extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'comment',
        'rating',
        'status',
    ];
    

    public function getStatusNameAttribute(): string
    {
        return ReviewStatusEnum::tryFrom($this->status)?->label() ?? 'Không xác định';
    }

}
