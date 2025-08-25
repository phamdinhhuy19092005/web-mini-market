<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\DiscountTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreCouponRequestInterface;
use Illuminate\Validation\Rule;

class StoreCouponRequest extends BaseFormRequest implements StoreCouponRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'title' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:coupons,code'],
            'discount_type' => ['required', 'integer', Rule::in(DiscountTypeEnum::values())],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'usage_limit' => ['nullable', 'integer', 'min:0'],
            'terms' => ['nullable', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN)
                ? ActivationStatus::ACTIVE
                : ActivationStatus::INACTIVE,
        ]);
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.string' => 'Tiêu đề phải là chuỗi ký tự.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',

            'code.required' => 'Mã coupon không được để trống.',
            'code.string' => 'Mã coupon phải là chuỗi ký tự.',
            'code.max' => 'Mã coupon không được vượt quá 50 ký tự.',
            'code.unique' => 'Mã coupon đã tồn tại, vui lòng chọn mã khác.',

            'discount_type.required' => 'Loại giảm giá không được để trống.',
            'discount_type.integer' => 'Loại giảm giá phải là số nguyên.',
            'discount_type.in' => 'Loại giảm giá không hợp lệ.',

            'discount_value.required' => 'Giá trị giảm giá không được để trống.',
            'discount_value.numeric' => 'Giá trị giảm giá phải là số.',
            'discount_value.min' => 'Giá trị giảm giá không được nhỏ hơn 0.',

            'usage_limit.integer' => 'Giới hạn sử dụng phải là số nguyên.',
            'usage_limit.min' => 'Giới hạn sử dụng không được nhỏ hơn 0.',

            'terms.string' => 'Điều khoản phải là chuỗi ký tự.',

            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',

            'status.required' => 'Trạng thái coupon không được để trống.',
            'status.in' => 'Trạng thái coupon không hợp lệ.',
        ];
    }

    public function imageFile()
    {
        return null;
    }
}
