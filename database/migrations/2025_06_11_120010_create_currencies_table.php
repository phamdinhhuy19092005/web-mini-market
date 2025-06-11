<?php

use App\Enum\CurrencyTypeEnum;
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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment(CurrencyTypeEnum::class);
            $table->string('name');
            $table->char('code', 30)->comment('for fiat use iso3 format.');
            $table->string('symbol')->nullable();
            $table->tinyInteger('decimals')->default(2);
            $table->tinyInteger('status')->default(true);
            $table->json('used_countries')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
