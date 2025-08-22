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
        Schema::table('deposit_transactions', function (Blueprint $table) {
            $table->nullableMorphs('created_by'); 
            $table->nullableMorphs('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deposit_transactions', function (Blueprint $table) {
            $table->dropMorphs('created_by');
            $table->dropMorphs('updated_by');
        });
    }
};
