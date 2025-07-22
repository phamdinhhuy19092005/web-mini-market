<?php

use App\Enum\ActivationStatusEnum;
use App\Enum\DiscountConditionTypeEnum;
use App\Enum\DiscountTypeEnum;
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
        Schema::create('auto_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->tinyInteger('discount_type')->comment(DiscountTypeEnum::class);
            $table->decimal('discount_value', 10, 2);
            $table->string('condition_type')->comment(DiscountConditionTypeEnum::class);
            $table->string('condition_value')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('status')->comment(ActivationStatusEnum::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_discounts');
    }
};
