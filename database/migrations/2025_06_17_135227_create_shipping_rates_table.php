<?php

use App\Enum\ShippingRateTypeEnum;
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
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('shipping_zone_id')->nullable()->constrained('shipping_zones')->nullOnDelete();;
            $table->foreignId('carrier_id')->nullable()->constrained('carriers')->nullOnDelete();
            $table->string('delivery_takes')->nullable();
            $table->tinyInteger('type')->comment(ShippingRateTypeEnum::class);
            $table->decimal('minimum', 20, 6)->nullable();
            $table->decimal('maximum', 20, 6)->nullable();
            $table->decimal('rate', 20, 6)->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('display_on_frontend')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_rates');
    }
};
