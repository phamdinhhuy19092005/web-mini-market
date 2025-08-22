<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deposit_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable()->after('user_id');
            $table->unique(['order_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::table('deposit_transactions', function (Blueprint $table) {
            $table->dropUnique(['order_id', 'user_id']);
            $table->dropColumn('order_id');
        });
    }
};
