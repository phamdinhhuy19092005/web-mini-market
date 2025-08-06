<?php

use App\Enum\ActivationStatusEnum;
use App\Enum\ShippingOptionTypeEnum;
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
        Schema::create('shipping_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('type')->comment(ShippingOptionTypeEnum::class);
            $table->string('logo')->nullable();
            $table->json('params')->nullable();
            $table->foreignId('shipping_provider_id');
            $table->text('expanded_content')->nullable();
            $table->json('supported_countries')->nullable();
            $table->json('supported_provinces')->nullable();
            $table->integer('order')->nullable();
            $table->tinyInteger('status')->comment(ActivationStatusEnum::class);
            $table->tinyInteger('display_on_frontend')->comment(ActivationStatusEnum::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_options');
    }
};
