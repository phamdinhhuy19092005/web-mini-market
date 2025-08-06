<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermsPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Cập nhật mới nhất từ Uchi Mart – Mua sắm thông minh mỗi ngày',
                'slug' => 'bai-moi-len',
                'category_slug' => 'bai-moi-len',
                'content' => <<<HTML
<h2>Tin tức & xu hướng mỗi ngày</h2>
<p>Uchi Mart không chỉ là siêu thị thực phẩm, mà còn là nguồn thông tin tiêu dùng tin cậy cho mọi gia đình. Chuyên mục “Bài mới lên” là nơi bạn có thể cập nhật nhanh chóng những bài viết mới nhất về mẹo tiêu dùng, món ngon, công thức nấu ăn, và các chương trình khuyến mãi đặc biệt.</p>
<p>Chúng tôi thường xuyên cập nhật các sản phẩm vừa nhập kho, giới thiệu những thương hiệu mới, xu hướng thực phẩm sạch và công nghệ tiêu dùng tiện ích. Mỗi bài viết đều được chọn lọc kỹ lưỡng, giúp bạn dễ dàng bắt kịp với nhịp sống hiện đại mà vẫn tiết kiệm thời gian mua sắm.</p>
<p>Đừng bỏ lỡ cơ hội khám phá những điều bất ngờ mỗi ngày cùng Uchi Mart – nơi mỗi bài viết không chỉ mang thông tin, mà còn khơi nguồn cảm hứng sống khoẻ mạnh và tinh tế.</p>
HTML,
            ],
            [
                'title' => 'Công thức nấu ăn dễ làm – Bữa cơm gia đình thêm tròn vị',
                'slug' => 'cong-thuc-nau-an',
                'category_slug' => 'cong-thuc-nau-an',
                'content' => <<<HTML
<h2>Gợi ý món ăn hàng ngày</h2>
<p>Không cần là đầu bếp chuyên nghiệp, bạn vẫn có thể tự tay chuẩn bị những bữa ăn ngon lành cho cả nhà với các công thức đơn giản từ Uchi Mart. Từ món mặn dân dã như cá kho tộ, thịt rang cháy cạnh, đến món canh thanh đạm hay đồ tráng miệng nhẹ nhàng – tất cả đều có mặt tại chuyên mục “Công thức nấu ăn”.</p>
<p>Chúng tôi hướng dẫn từng bước rõ ràng, kèm theo hình ảnh minh họa và mẹo lựa chọn nguyên liệu tươi ngon (đặc biệt là nguyên liệu sẵn có tại Uchi Mart). Đây là nơi bạn có thể học thêm món mới mỗi ngày, nêm thêm yêu thương vào bữa cơm gia đình.</p>
<p>Hãy biến gian bếp thành không gian sáng tạo – nơi mà mỗi bữa ăn là một hành trình đầy cảm xúc.</p>
HTML,
            ],
            [
                'title' => 'Khám phá món ngon bốn phương – Đưa thế giới ẩm thực về nhà bạn',
                'slug' => 'mon-ngon',
                'category_slug' => 'mon-ngon',
                'content' => <<<HTML
<h2>Ẩm thực Việt và quốc tế</h2>
<p>Ẩm thực là cầu nối văn hóa tuyệt vời nhất, và Uchi Mart chính là nơi bạn có thể “du lịch vị giác” ngay tại gian bếp nhà mình. Mục “Món ngon” giới thiệu hàng trăm món ăn đặc sắc từ khắp nơi: phở bò Hà Nội, hủ tiếu Nam Vang, mì Udon Nhật Bản hay pasta kiểu Ý.</p>
<p>Bên cạnh món chính, chúng tôi cũng chia sẻ cách làm các món ăn vặt, nước uống detox, salad nhẹ nhàng cho dân văn phòng, hay món nhậu lai rai cuối tuần. Đặc biệt, mỗi món ăn đều có gợi ý nguyên liệu mua tại Uchi Mart để bạn không mất công tìm kiếm.</p>
<p>Hãy để món ngon trở thành niềm vui mỗi ngày, nơi bạn vừa thưởng thức vừa cảm nhận được nhịp sống muôn màu qua từng bữa ăn.</p>
HTML,
            ],
            [
                'title' => 'Review chân thực – Trải nghiệm thật từ khách hàng thật',
                'slug' => 'review',
                'category_slug' => 'review',
                'content' => <<<HTML
<h2>Chọn đúng, mua chuẩn</h2>
<p>Đứng giữa hàng trăm sản phẩm tương tự, làm sao biết cái nào phù hợp với nhu cầu của bạn? Hãy để chuyên mục “Review” của Uchi Mart giúp bạn có góc nhìn rõ ràng và thực tế hơn.</p>
<p>Từ đồ dùng nhà bếp, thực phẩm chức năng, sản phẩm organic, đến đồ uống, đồ gia dụng – chúng tôi đưa ra đánh giá chi tiết dựa trên trải nghiệm người dùng thật. Bên cạnh đó là những nhận xét khách quan về ưu – nhược điểm, chất lượng, giá thành và độ tiện dụng.</p>
<p>Mỗi bài review đều kèm ảnh thật, video thực tế, và so sánh giữa các sản phẩm tương đương để bạn ra quyết định dễ dàng, tiết kiệm và hiệu quả hơn.</p>
HTML,
            ],
            [
                'title' => 'Sinh nhật Uchi Mart – Cột mốc đáng nhớ, tri ân ngập tràn',
                'slug' => 'sinh-nhat-uchi-mart',
                'category_slug' => 'sinh-nhat-uchi-mart',
                'content' => <<<HTML
<h2>Hành trình 1 năm – 365 ngày phục vụ tận tâm</h2>
<p>Sinh nhật Uchi Mart không chỉ là dịp kỷ niệm mà còn là cơ hội để chúng tôi tri ân những khách hàng đã đồng hành và tin tưởng. Mỗi năm, sự kiện này được tổ chức với chủ đề riêng, kèm theo hàng loạt chương trình ưu đãi như “mua 1 tặng 1”, hoàn tiền, quà tặng miễn phí cho đơn hàng bất kỳ.</p>
<p>Chúng tôi cũng tổ chức chuỗi livestream, mini game, sự kiện offline gắn kết để khách hàng và nhân viên cùng nhau chia sẻ khoảnh khắc đáng nhớ. Sinh nhật là cột mốc đánh dấu sự trưởng thành – và Uchi Mart luôn muốn chia sẻ niềm vui ấy cùng bạn.</p>
HTML,
            ],
            [
                'title' => 'Mẹo vặt mỗi ngày – Bí quyết nhỏ, hiệu quả lớn',
                'slug' => 'meo-vat',
                'category_slug' => 'meo-vat',
                'content' => <<<HTML
<h2>Tiết kiệm và hiệu quả</h2>
<p>“Mẹo vặt” không chỉ là những thủ thuật nấu ăn mà còn là bí quyết tiêu dùng thông minh, sắp xếp cuộc sống tiện nghi hơn mỗi ngày. Từ cách bóc tỏi siêu nhanh, khử mùi tủ lạnh bằng vỏ cam, đến mẹo dùng túi zip để bảo quản thực phẩm lâu hơn – tất cả đều có trong chuyên mục này.</p>
<p>Uchi Mart tin rằng sự khéo léo trong tiêu dùng bắt đầu từ những điều nhỏ. Mỗi mẹo nhỏ giúp bạn tiết kiệm vài phút, vài nghìn đồng, nhưng cộng dồn lại sẽ mang đến một cuộc sống thoải mái và chủ động hơn.</p>
HTML,
            ],
            [
                'title' => 'Trung Thu đoàn viên – Gợi ý quà tặng và món ngon mùa trăng',
                'slug' => 'trung-thu',
                'category_slug' => 'trung-thu',
                'content' => <<<HTML
<h2>Thắp sáng mùa lễ hội</h2>
<p>Trung Thu không chỉ là dịp tặng bánh mà còn là khoảnh khắc gắn kết gia đình. Uchi Mart giới thiệu đến bạn những mẫu bánh trung thu đẹp mắt, hương vị phong phú – từ cổ truyền như thập cẩm, đậu xanh, trứng muối đến hiện đại như phô mai, matcha, sầu riêng.</p>
<p>Bên cạnh đó là các gợi ý hộp quà sang trọng để biếu đối tác, đồng nghiệp hay người thân. Bạn còn có thể tìm thấy phụ kiện trang trí, lồng đèn, nguyên liệu mâm cỗ và hướng dẫn tổ chức Trung Thu cho bé ngay tại chuyên mục này.</p>
HTML,
            ],
            [
                'title' => 'Từ điển trái cây – Ăn đúng loại, đúng cách, đúng mùa',
                'slug' => 'tu-dien-trai-cay',
                'category_slug' => 'tu-dien-trai-cay',
                'content' => <<<HTML
<h2>Thấu hiểu trái cây để sống khoẻ mạnh</h2>
<p>Không phải loại trái cây nào cũng phù hợp cho mọi cơ địa và mục đích sử dụng. Với chuyên mục “Từ điển trái cây”, Uchi Mart giúp bạn tìm hiểu đặc tính từng loại: từ dưa hấu giúp giải nhiệt, chuối bổ sung kali, đến bưởi hỗ trợ giảm cân hay nho giàu chất chống oxy hóa.</p>
<p>Chúng tôi cung cấp thông tin về mùa vụ, nguồn gốc, cách chọn mua, bảo quản và cả cách kết hợp dinh dưỡng để mang lại hiệu quả tối đa. Từ đó, bạn có thể xây dựng chế độ ăn lành mạnh, khoa học hơn – bắt đầu từ những loại trái cây quen thuộc hằng ngày.</p>
HTML,
            ],
        ];

        // Remove duplicate entry for 'Sinh nhật Uchi Mart'
        $posts = array_values(array_unique($posts, SORT_REGULAR));

        foreach ($posts as $index => $post) {
            // Fetch category ID based on category slug
            $categoryId = DB::table('post_categories')
                ->where('slug', $post['category_slug'])
                ->value('id');

            if ($categoryId) {
                DB::table('posts')->updateOrInsert(
                    ['slug' => $post['slug']],
                    [
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
                    ]
                );
            }
        }
    }
}
