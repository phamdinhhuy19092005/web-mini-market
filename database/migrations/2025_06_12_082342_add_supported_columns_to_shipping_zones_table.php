<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('shipping_zones', function (Blueprint $table) {
            $table->json('supported_provinces')->nullable();
            $table->json('supported_districts')->nullable();
        });
    }

    public function down()
    {
        Schema::table('shipping_zones', function (Blueprint $table) {
            $table->dropColumn(['supported_provinces', 'supported_districts']);
        });
    }
};
