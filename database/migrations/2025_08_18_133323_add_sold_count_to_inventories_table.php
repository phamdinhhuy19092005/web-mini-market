<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->unsignedInteger('sold_count')->default(0)->after('stock_quantity');
        });
    }

    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('sold_count');
        });
    }

};
