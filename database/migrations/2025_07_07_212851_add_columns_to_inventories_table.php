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
        Schema::table('inventories', function (Blueprint $table) {
            $table->boolean('display_on_frontend')->default(false);
            $table->boolean('allow_frontend_search')->default(false);
            $table->string('meta_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn([
                'display_on_frontend',
                'allow_frontend_search',
                'meta_keywords',
            ]);
        });
    }
};
