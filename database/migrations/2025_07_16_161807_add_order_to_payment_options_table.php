<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('payment_options', function (Blueprint $table) {
        $table->integer('order')->nullable()->after('name');
    });
}

public function down(): void
{
    Schema::table('payment_options', function (Blueprint $table) {
        $table->dropColumn('order');
    });
} 
};
