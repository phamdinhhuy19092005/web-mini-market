<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermsPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Chính sách bảo mật thông tin',
                'slug' => 'bao-mat',
                'category_slug' => 'bao-mat',
                'content' => <<<HTML
<h2>1. Giới thiệu</h2>
<p>Chính sách bảo mật thông tin quy định cách thu thập, sử dụng, lưu trữ và bảo vệ dữ liệu khách hàng khi sử dụng Uchi Mart.</p>
<h2>2. Mục đích sử dụng</h2>
<p>Uchi Mart thu thập thông tin để xử lý đặt hàng, hỗ trợ khách hàng, cải tiến dịch vụ và phòng chống gian lận.</p>
<h2>3. Phạm vi sử dụng</h2>
<p>Chỉ nhân viên được phép, đối tác liên quan và cơ quan nhà nước mới được truy cập thông tin trong các trường hợp cần thiết.</p>
<h2>4. Lưu trữ và bảo mật</h2>
<p>Uchi Mart lưu trữ thông tin trên hệ thống và áp dụng các biện pháp đảm bảo an toàn cho dữ liệu khách hàng.</p>
<h2>5. Liên hệ</h2>
<p>Email: hotro@uchimart.site | Hotline: 18006868</p>
HTML
            ],
            [
                'title' => 'Chính sách giao hàng',
                'slug' => 'chinh-sach-giao-hang',
                'category_slug' => 'chinh-sach-giao-hang',
                'content' => <<<HTML
<h2>1. Phạm vi giao hàng</h2>
<p>Uchi Mart giao hàng tới tất cả các tỉnh thành Việt Nam.</p>
<h2>2. Thời gian giao hàng</h2>
<p>Thông thường trong 1-5 ngày làm việc tùy khu vực.</p>
<h2>3. Phí giao hàng</h2>
<p>Miễn phí với đơn từ 500.000đ trở lên. Đối với đơn thấp hơn, phí được tính theo bảng giá hiện hành.</p>
HTML
            ],
            [
                'title' => 'Chính sách thanh toán',
                'slug' => 'chinh-sach-thanh-toan',
                'category_slug' => 'chinh-sach-thanh-toan',
                'content' => <<<HTML
<h2>1. Hình thức thanh toán</h2>
<ul>
    <li>Thanh toán khi nhận hàng (COD)</li>
    <li>Chuyển khoản qua ngân hàng</li>
    <li>Thanh toán online qua ví điện tử</li>
</ul>
<h2>2. Bảo mật giao dịch</h2>
<p>Chúng tôi áp dụng các biện pháp mã hoá giao dịch để bảo vệ thông tin thanh toán của bạn.</p>
HTML
            ],
            [
                'title' => 'Chính sách đổi trả',
                'slug' => 'chinh-sach-doi-tra',
                'category_slug' => 'chinh-sach-doi-tra',
                'content' => <<<HTML
<h2>1. Điều kiện đổi trả</h2>
<p>Sản phẩm còn nguyên tem, bao bì, chưa qua sử dụng.</p>
<h2>2. Thời gian đổi trả</h2>
<p>Trong vòng 07 ngày tính từ ngày nhận hàng.</p>
<h2>3. Chi phí</h2>
<p>Uchi Mart hỗ trợ đổi trả miễn phí trong trường hợp sản phẩm lỗi do nhà sản xuất hoặc giao sai.</p>
HTML
            ],
            [
                'title' => 'Hướng dẫn mua hàng',
                'slug' => 'huong-dan-mua-hang',
                'category_slug' => 'huong-dan-mua-hang',
                'content' => <<<HTML
<h2>1. Bước 1</h2>
<p>Truy cập website Uchi Mart tại <a href="https://uchimart.site">uchimart.site</a></p>
<h2>2. Bước 2</h2>
<p>Chọn sản phẩm, thêm vào giỏ hàng, nhập đầy đủ thông tin giao hàng</p>
<h2>3. Bước 3</h2>
<p>Xác nhận và thanh toán</p>
HTML
            ],
            [
                'title' => 'Điều khoản và điều kiện giao dịch',
                'slug' => 'dieu-khoan',
                'category_slug' => 'dieu-khoan',
                'content' => <<<HTML
<h2>1. Quy định chung</h2>
<p>Khi truy cập website uchimart.site, khách hàng chấp nhận các điều khoản sử dụng và chính sách của chúng tôi.</p>
<h2>2. Nghĩa vụ khách hàng</h2>
<p>Cung cấp thông tin chính xác và tuân thủ các quy trình mua hàng.</p>
<h2>3. Cam kết của Uchi Mart</h2>
<p>Chúng tôi cam kết cung cấp sản phẩm chính hãng, rõ nguồn gốc và bảo hành đầy đủ.</p>
HTML
            ],
        ];

        foreach ($posts as $index => $post) {
            $categoryId = DB::table('post_categories')->where('slug', $post['category_slug'])->value('id');

            if ($categoryId) {
                DB::table('posts')->insert([
                    'name' => $post['title'],
                    'slug' => $post['slug'],
                    'code' => $post['slug'],
                    'post_category_id' => $categoryId,
                    'description' => 'Bài viết chi tiết về ' . strtolower($post['title']),
                    'content' => $post['content'],
                    'image' => null,
                    'post_at' => now(),
                    'order' => $index + 1,
                    'display_on_frontend' => 1,
                    'meta_title' => $post['title'] . ' | Uchi Mart',
                    'meta_description' => 'Tìm hiểu ' . strtolower($post['title']) . ' tại Uchi Mart',
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'view_count' => 0,
                    'author' => 'Uchi Mart',
                ]);
            }
        }
    }
}
