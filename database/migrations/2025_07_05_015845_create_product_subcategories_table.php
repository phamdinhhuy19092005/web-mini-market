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
        Schema::create('product_subcategories', function (Blueprint $table) {
             $table->id();

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->timestamps();
            $table->unique(['product_id', 'subcategory_id']); 
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_subcategories');
    }
};
