<?php
namespace App\Models;

use App\Enum\ActivationStatus;
use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use Activatable;

    protected $fillable = [
        'name', 
        'label', 
        'type', 
        'cta_label', 
        'redirect_url', 
        'order',
        'color', 
        'desktop_image', 
        'mobile_image', 
        'description',
        'start_at', 
        'end_at', 
        'status'
    ];

}
