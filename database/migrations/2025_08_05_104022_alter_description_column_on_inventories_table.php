<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDescriptionColumnOnInventoriesTable extends Migration
{
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->longText('description')->nullable()->change(); 
        });
    }

    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->string('description', 255)->nullable(false)->change();
        });
    }
}
