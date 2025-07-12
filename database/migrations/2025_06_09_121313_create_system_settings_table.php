<?php

use App\Enum\SystemSettingValueTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_setting_group_id')->constrained('system_setting_groups')->onDelete('cascade');
            $table->string('label');
            $table->string('key');
            $table->json('value')->nullable();
            $table->string('value_type')->comment(SystemSettingValueTypeEnum::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
