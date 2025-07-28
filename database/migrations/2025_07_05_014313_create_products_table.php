<?php

use App\Enum\ProductTypeEnum;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->tinyInteger('type')->comment(ProductTypeEnum::class);
            $table->string('primary_image')->nullable();
            $table->json('media')->nullable();
            $table->json('suggested_relationships')->nullable();
            $table->morphs('created_by');
            $table->morphs('updated_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
