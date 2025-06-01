<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

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
