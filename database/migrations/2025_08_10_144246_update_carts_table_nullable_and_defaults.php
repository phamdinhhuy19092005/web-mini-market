<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Lấy tên foreign key hiện có của user_id
        $foreignKeyName = null;
        $results = DB::select("SHOW CREATE TABLE carts");
        if (!empty($results)) {
            $createTableSQL = $results[0]->{'Create Table'};
            if (preg_match('/CONSTRAINT `([^`]+)` FOREIGN KEY \(`user_id`\)/', $createTableSQL, $matches)) {
                $foreignKeyName = $matches[1];
            }
        }

        Schema::table('carts', function (Blueprint $table) use ($foreignKeyName) {
            // Drop foreign key nếu tồn tại
            if ($foreignKeyName) {
                $table->dropForeign($foreignKeyName);
            }

            // Thay đổi các cột
            $table->foreignId('user_id')->nullable()->change();

            // Chỉ thay đổi nullable, không gọi ->unique() nữa
            $table->uuid('uuid')->nullable()->change();

            $table->decimal('total_price', 20, 6)->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change();
            $table->uuid('uuid')->nullable(false)->change();
            $table->decimal('total_price', 20, 6)->default(null)->change();

            // Thêm lại foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
