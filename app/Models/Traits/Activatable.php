<?php 

namespace App\Models\Traits;

use App\Enum\ActivationStatus;

trait Activatable
{
    public function getStatusNameAttribute(): string
    {
        return ActivationStatus::label($this->status);
    }   
}