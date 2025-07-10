<?php

namespace App\Models;

use App\Enum\ActivationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// CategoryGroup -> Model

class CategoryGroup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'seo_title',
        'seo_description',
        'status',
        'created_at',
        'updated_at'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function getStatusNameAttribute(): string
    {
        return ActivationStatus::label($this->status);
    }
}
