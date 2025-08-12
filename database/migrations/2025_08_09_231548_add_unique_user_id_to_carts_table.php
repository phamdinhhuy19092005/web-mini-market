<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Bước 1: Gộp cart trùng user_id
        $duplicateUsers = DB::table('carts')
            ->select('user_id')
            ->whereNotNull('user_id')
            ->groupBy('user_id')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('user_id');

        foreach ($duplicateUsers as $userId) {
            $carts = DB::table('carts')
                ->where('user_id', $userId)
                ->orderBy('id')
                ->get();

            $mainCart = $carts->first();

            foreach ($carts->skip(1) as $oldCart) {
                // Gộp item từ cart cũ sang cart chính
                DB::table('cart_items')
                    ->where('cart_id', $oldCart->id)
                    ->update(['cart_id' => $mainCart->id]);

                // Xóa cart cũ
                DB::table('carts')->where('id', $oldCart->id)->delete();
            }
        }

        // Bước 2: Thêm ràng buộc unique
        Schema::table('carts', function (Blueprint $table) {
            $table->unique('user_id', 'unique_user_cart');
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropUnique('unique_user_cart');
        });
    }
};
