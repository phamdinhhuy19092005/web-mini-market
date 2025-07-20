<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TermsAndConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'name' => 'Điều khoản và Điều kiện giao dịch',
            'slug' => Str::slug('Điều khoản và Điều kiện giao dịch'),
            'code' => 'terms-and-conditions',
            'post_category_id' => null, // hoặc ID danh mục phù hợp
            'description' => 'Bản điều khoản và điều kiện giao dịch cho website uchimart.site',
            'content' => <<<HTML
<h2>1. Quy định chung</h2>
<p>Website <strong>uchimart.site</strong> do Công ty Uchi Mart phát triển và vận hành. Khi truy cập website, người dùng đồng ý với các điều khoản sử dụng và chính sách của chúng tôi.</p>

<h2>2. Quy định về tài khoản</h2>
<p>Khách hàng phải cung cấp thông tin chính xác khi đăng ký. Uchi Mart không chịu trách nhiệm nếu thông tin sai lệch gây ảnh hưởng đến quyền lợi khách hàng.</p>

<h2>3. Quy trình mua hàng</h2>
<ol>
    <li>Chọn sản phẩm và thêm vào giỏ hàng.</li>
    <li>Điền thông tin giao hàng và chọn phương thức thanh toán.</li>
    <li>Nhận email xác nhận đơn hàng từ hệ thống uchimart.site.</li>
</ol>

<h2>4. Bảo mật thông tin</h2>
<p>Chúng tôi cam kết bảo vệ thông tin cá nhân của khách hàng theo chính sách bảo mật đã công bố.</p>

<h2>5. Giải quyết khiếu nại</h2>
<p>Mọi khiếu nại vui lòng liên hệ qua email: <a href="mailto:hotro@uchimart.site">hotro@uchimart.site</a>. Chúng tôi sẽ phản hồi trong vòng 3 ngày làm việc.</p>

<h2>6. Thay đổi điều khoản</h2>
<p>Uchi Mart có quyền sửa đổi điều khoản bất kỳ lúc nào. Khách hàng nên kiểm tra thường xuyên để cập nhật các thay đổi mới nhất.</p>
HTML,
            'image' => null,
            'post_at' => Carbon::now(),
            'order' => 0,
            'display_on_frontend' => 1,
            'meta_title' => 'Điều khoản và Điều kiện giao dịch | Uchi Mart',
            'meta_description' => 'Xem điều khoản và điều kiện giao dịch của website uchimart.site',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'view_count' => 0,
        ]);
    }
}
