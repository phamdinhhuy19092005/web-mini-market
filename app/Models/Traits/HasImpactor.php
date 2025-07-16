<?php 

namespace App\Models\Traits;

trait HasImpactor
{
    public function createdBy()
    {
        return $this->morphTo();
    }

    public function updatedBy()
    {
        return $this->morphTo();
    }
}
