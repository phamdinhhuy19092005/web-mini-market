<?php

use App\Enum\ActivationStatusEnum;
use App\Enum\PaymentOptionTypeEnum;
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
        Schema::create('payment_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('type')->comment(PaymentOptionTypeEnum::class);
            $table->decimal('min_amount', 27, 18)->nullable();
            $table->decimal('max_amount', 27, 18)->nullable();
            $table->string('currency_code');
            $table->string('logo')->nullable();
            $table->tinyInteger('status')->comment(ActivationStatusEnum::class);
            $table->string('online_banking_code')->nullable();
            $table->foreignId('payment_provider_id')->nullable();
            $table->json('params')->nullable();
            $table->tinyInteger('display_on_frontend')->comment(ActivationStatusEnum::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_options');
    }
};
