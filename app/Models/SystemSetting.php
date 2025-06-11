<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemSetting extends Model
{
    protected $table = 'system_settings';

    protected $fillable = [
        'system_setting_group_id',
        'label',
        'key',
        'value',
        'value_type',
    ];

    /**
     * Get the group that owns the setting.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(SystemSettingGroup::class, 'system_setting_group_id', 'id');
    }
}
