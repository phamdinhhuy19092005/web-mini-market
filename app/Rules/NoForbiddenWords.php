<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoForbiddenWords implements ValidationRule
{

    protected array $forbiddenWords = [
        'đụ', 'lồn', 'cặc', 'đĩ', 'chó', 'vcl', 'cc', 'dm', 'kkk', 'ngu', 'đm', 'ml', 'đm', 'clgt', 'đmm', 'thằng chó',

        'fuck', 'shit', 'bitch', 'asshole', 'bastard', 'damn', 'crap', 'piss', 'dick', 'cock', 'slut', 'whore', 'nigger',

        'mua 1 tặng 1', 'khuyến mãi', 'giảm giá sốc', 'click vào link', 'free', 'miễn phí', 'quà tặng', 'voucher', 'deal', 'khuyến mại',

        'http://', 'https://', 'www.', '.com', '.net', '.org', '@', '1234567890', '0987654321', '0000000000', 'abc@xyz.com',

        'casino', 'slot', 'xóc đĩa', 'đánh bạc', 'cờ bạc', 'ma túy', 'heroin', 'cocaine', 'bạo lực', 'sát hại', 'giết người',

        'sex', 'porn', 'nude', '18+', 'đồi trụy', 'khiêu dâm', 'gái gọi', 'dâm dục',

        'chính trị', 'bạo động', 'biểu tình', 'đảng', 'tổng thống', 'cách mạng',

        'spam', 'bot', 'hack', 'key lậu', 'phần mềm lậu',
    ];


    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->forbiddenWords as $word) {
            if (stripos($value, $word) !== false) {
                $fail("Trường {$attribute} chứa từ cấm: {$word}");
                return;
            }
        }
    }
}
