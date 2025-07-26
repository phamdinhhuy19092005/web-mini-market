<?php

use App\Enum\ReviewStatusEnum;
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
        Schema::create('website_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); 
            $table->string('email')->nullable();
            $table->tinyInteger('rating');
            $table->text('comment')->nullable();
            $table->tinyInteger('status')->comment(ReviewStatusEnum::class); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_reviews');
    }
};
