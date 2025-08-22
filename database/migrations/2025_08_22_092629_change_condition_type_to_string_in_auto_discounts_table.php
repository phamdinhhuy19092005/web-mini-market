<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('auto_discounts', function (Blueprint $table) {
            $table->string('condition_type')->change();
        });
    }

    public function down(): void
    {
        Schema::table('auto_discounts', function (Blueprint $table) {
            $table->integer('condition_type')->change();
        });
    }
};

