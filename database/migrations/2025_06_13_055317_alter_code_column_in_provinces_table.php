<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('provinces', function (Blueprint $table) {
            // Nếu chưa có unique thì thêm vào
            $table->string('code', 20)->change();
        });
    }

    public function down(): void
    {
        Schema::table('provinces', function (Blueprint $table) {
            // Bỏ unique nếu rollback
            $table->string('code', 20)->change();
        });
    }
};
