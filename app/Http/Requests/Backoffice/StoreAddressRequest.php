<?php

namespace App\Http\Requests\Backoffice;

use App\Http\Requests\Backoffice\Interfaces\StoreAddressRequestInterface;
use Illuminate\Validation\Rule;

class StoreAddressRequest extends BaseFormRequest implements StoreAddressRequestInterface
{
    public function rules(): array
    {   
        // dd($this->all());
        return [
            'user_id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(0|\+84)[0-9]{9}$/'],

            'supported_provinces' => ['required', 'array', 'min:1'],
            'supported_provinces.0' => ['required', 'exists:provinces,code'],

            'supported_districts' => ['required', 'array', 'min:1'],
            'supported_districts.0' => ['required', 'exists:districts,code'],

            'supported_wards' => ['required', 'array', 'min:1'],
            'supported_wards.0' => ['required', 'exists:wards,code'],
            
            'address_line' => ['required', 'string', 'max:500'],
            'is_default' => ['nullable', 'boolean'],
        ];
    }


    public function imageFile()
    {
        return null;
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

}
