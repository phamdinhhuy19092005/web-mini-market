<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FaqQuestionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('faqs')->insert([
            [
                'question' => 'Làm sao để tạo tài khoản trên Uchi Mart?',
                'answer' => 'Bạn có thể tạo tài khoản bằng cách nhấn vào nút "Đăng ký" trên trang chủ và điền đầy đủ thông tin cá nhân.',
                'order' => 1,
                'faq_topic_id' => 1, // Tương ứng với chủ đề "Tài khoản"
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'Tôi quên mật khẩu thì làm thế nào?',
                'answer' => 'Bạn nhấn vào "Quên mật khẩu?" ở trang đăng nhập để đặt lại mật khẩu qua email đã đăng ký.',
                'order' => 2,
                'faq_topic_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'Phí vận chuyển được tính như thế nào?',
                'answer' => 'Phí vận chuyển được tính dựa trên địa chỉ giao hàng và tổng khối lượng đơn hàng.',
                'order' => 1,
                'faq_topic_id' => 2, // "Vận chuyển"
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'Tôi có thể theo dõi đơn hàng ở đâu?',
                'answer' => 'Bạn có thể theo dõi trạng thái đơn hàng trong mục "Đơn hàng của tôi" sau khi đăng nhập.',
                'order' => 2,
                'faq_topic_id' => 2,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'Tôi có thể đổi/trả hàng trong bao lâu?',
                'answer' => 'Bạn có thể đổi/trả hàng trong vòng 7 ngày kể từ ngày nhận hàng, theo điều kiện đổi trả của Uchi Mart.',
                'order' => 1,
                'faq_topic_id' => 3, // "Đổi trả"
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'Sản phẩm như thế nào thì được đổi trả?',
                'answer' => 'Sản phẩm phải còn nguyên tem, nhãn và chưa qua sử dụng. Không áp dụng cho thực phẩm tươi sống.',
                'order' => 2,
                'faq_topic_id' => 3,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'Những phương thức thanh toán nào được chấp nhận?',
                'answer' => 'Chúng tôi chấp nhận thanh toán bằng tiền mặt, chuyển khoản, ví điện tử (Momo, ZaloPay) và thẻ ngân hàng.',
                'order' => 1,
                'faq_topic_id' => 4, // "Thanh toán"
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'Thanh toán có an toàn không?',
                'answer' => 'Mọi thông tin thanh toán được mã hóa và bảo mật theo tiêu chuẩn PCI DSS.',
                'order' => 2,
                'faq_topic_id' => 4,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'Uchi Mart có giao hàng toàn quốc không?',
                'answer' => 'Chúng tôi giao hàng toàn quốc, ngoại trừ một số khu vực vùng sâu vùng xa.',
                'order' => 1,
                'faq_topic_id' => 5, // "Khác"
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'Làm sao để liên hệ chăm sóc khách hàng?',
                'answer' => 'Bạn có thể gọi đến số hotline 1900.xxx.xxx hoặc gửi email đến support@uchimart.vn.',
                'order' => 2,
                'faq_topic_id' => 5,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
