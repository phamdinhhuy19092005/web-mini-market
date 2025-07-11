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
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name', 255);
            $table->string('name_en', 255)->nullable();
            $table->string('full_name', 255);
            $table->string('full_name_en', 255)->nullable();
            $table->string('code_name', 255)->nullable();
            $table->foreignId('administrative_unit_id')->nullable()->constrained('administrative_units')->nullOnDelete();
            $table->foreignId('administrative_region_id')->nullable()->constrained('administrative_regions')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
