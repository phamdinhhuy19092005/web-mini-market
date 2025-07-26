<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqTopicSeeder extends Seeder
{
    public function run(): void
    {
        $topics = [
            'Tài khoản và đăng nhập',
            'Đặt hàng',
            'Thanh toán',
            'Giao hàng và vận chuyển',
            'Đổi trả và hoàn tiền',
            'Bảo mật thông tin',
            'Khuyến mãi và mã giảm giá',
            'Sản phẩm và tồn kho',
            'Liên hệ hỗ trợ',
            'Điều khoản và điều kiện sử dụng',
        ];

        foreach ($topics as $index => $name) {
            DB::table('faq_topics')->insert([
                'name' => $name,
                'order' => $index + 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
