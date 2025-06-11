<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SystemSettingGroup extends Model
{
    protected $table = 'system_setting_groups';

    protected $fillable = [
        'name',
        'order',
    ];

    /**
     * Get the system settings for the group.
     */
    public function systemSettings(): HasMany
    {
        return $this->hasMany(SystemSetting::class, 'system_setting_group_id', 'id');
    }
}
