<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Nếu bạn muốn dọn các cart trùng user_id trước
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
                DB::table('cart_items')
                    ->where('cart_id', $oldCart->id)
                    ->update(['cart_id' => $mainCart->id]);

                DB::table('carts')->where('id', $oldCart->id)->delete();
            }
        }

        // Bỏ ràng buộc unique trên user_id nếu có (trường hợp migration cũ đã thêm)
        Schema::table('carts', function (Blueprint $table) {
            $table->dropUnique('unique_user_cart'); // 'unique_user_cart' là tên constraint cũ
        });
    }

    public function down(): void
    {
        // Nếu muốn, bạn có thể thêm lại ràng buộc unique user_id
        Schema::table('carts', function (Blueprint $table) {
            $table->unique('user_id', 'unique_user_cart');
        });
    }
};
