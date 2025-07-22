<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->string('uuid');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('currency_code')->nullable()->default('VND');
            $table->string('fullname');
            $table->string('email');
            $table->string('phone', 20);
            $table->char('country_code', 3)->nullable()->default('VND');
            $table->string('address_line')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
