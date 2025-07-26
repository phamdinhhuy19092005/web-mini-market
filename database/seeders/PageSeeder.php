<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'name' => 'Chính sách bảo mật',
                'slug' => 'chinh-sach-bao-mat',
                'title' => 'Chính sách bảo mật thông tin',
                'content' => '<p>Nội dung chi tiết của chính sách bảo mật thông tin.</p>',
            ],
            [
                'name' => 'Chính sách giao hàng',
                'slug' => 'chinh-sach-giao-hang',
                'title' => 'Chính sách giao hàng và vận chuyển',
                'content' => '<p>Nội dung chi tiết của chính sách giao hàng.</p>',
            ],
            [
                'name' => 'Chính sách thanh toán',
                'slug' => 'chinh-sach-thanh-toan',
                'title' => 'Chính sách thanh toán',
                'content' => '<p>Nội dung chi tiết của chính sách thanh toán.</p>',
            ],
            [
                'name' => 'Chính sách đổi trả',
                'slug' => 'chinh-sach-doi-tra',
                'title' => 'Chính sách đổi trả và bảo hành',
                'content' => '<p>Nội dung chi tiết của chính sách đổi trả.</p>',
            ],
            [
                'name' => 'Hướng dẫn mua hàng',
                'slug' => 'huong-dan-mua-hang',
                'title' => 'Hướng dẫn mua hàng trên website',
                'content' => '<p>Hướng dẫn chi tiết về cách mua hàng trên website.</p>',
            ],
            [
                'name' => 'Điều khoản giao dịch',
                'slug' => 'dieu-khoan-giao-dich',
                'title' => 'Điều khoản và điều kiện giao dịch',
                'content' => '<p>Các quy điịnh và điều kiện giao dịch khi sử dụng website.</p>',
            ],
        ];

        foreach ($pages as $index => $page) {
            DB::table('pages')->insert([
                'display_in' => null,
                'name' => $page['name'],
                'slug' => $page['slug'],
                'custom_redirect_url' => null,
                'title' => $page['title'],
                'order' => $index + 1,
                'status' => 1,
                'content' => $page['content'],
                'meta_title' => $page['title'] . ' | Uchi Mart',
                'meta_description' => 'Tìm hiểu ' . strtolower($page['title']) . ' tại website Uchi Mart.',
                'display_on_frontend' => 1,
                'created_by_type' => 'admin',
                'created_by_id' => 1,
                'updated_by_type' => 'admin',
                'updated_by_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

