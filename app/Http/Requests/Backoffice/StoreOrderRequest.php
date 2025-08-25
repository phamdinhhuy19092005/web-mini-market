<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\AccessChannelOptions;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\ShippingOption;
use App\Models\PaymentOption;
use Illuminate\Validation\Rule;
use App\Http\Requests\Backoffice\Interfaces\StoreOrderRequestInterface;

class StoreOrderRequest extends BaseFormRequest implements StoreOrderRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'user_id' => ['required', Rule::exists(User::class, 'id')],
            'cart_items' => ['required', 'array', 'min:1'],
            'cart_items.*.inventory_id' => ['required', 'integer', Rule::exists(Inventory::class, 'id')],
            'cart_items.*.quantity' => ['required', 'integer', 'gt:0'],
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'company' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:255'],
            'coupon_id' => ['nullable', 'integer', Rule::exists('coupons', 'id')],
            'address_line' => ['nullable', 'string', 'max:255'],
            'province_code' => ['required', Rule::in(Province::query()->pluck('code')->toArray())],
            'district_code' => ['required', Rule::in(District::query()->pluck('code')->toArray())],
            'ward_code' => ['required', Rule::in(Ward::query()->pluck('code')->toArray())],
            'shipping_option_id' => ['required', Rule::exists(ShippingOption::class, 'id')],
            'payment_option_id' => ['required', Rule::exists(PaymentOption::class, 'id')],
            'order_channel' => ['required', 'array'],
            'order_channel.type' => ['required', Rule::in(AccessChannelOptions::all())],
            'order_channel.reference_id' => ['nullable', 'string'],
            'total_price' => ['required', 'numeric', 'gte:0'],
            'total_quantity' => ['required', 'integer', 'gte:1'],
            'user_note' => ['nullable', 'string', 'max:500'],
            'admin_note' => ['nullable', 'string', 'max:500'],
        ];
    }


    public function prepareForValidation()
    {
        $validatedData = $this->all();
        data_set($validatedData, 'order_channel.type', (int) data_get($validatedData, 'order_channel.type'));
        $this->merge($validatedData);
    }

    public function imageFile()
    {
        return null;
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Người dùng không được để trống.',
            'user_id.exists' => 'Người dùng không tồn tại.',

            'cart_items.required' => 'Giỏ hàng không được để trống.',
            'cart_items.array' => 'Giỏ hàng phải là mảng.',
            'cart_items.min' => 'Giỏ hàng phải có ít nhất 1 sản phẩm.',

            'cart_items.*.inventory_id.required' => 'Sản phẩm không được để trống.',
            'cart_items.*.inventory_id.integer' => 'Sản phẩm phải là số nguyên.',
            'cart_items.*.inventory_id.exists' => 'Sản phẩm không tồn tại.',

            'cart_items.*.quantity.required' => 'Số lượng sản phẩm không được để trống.',
            'cart_items.*.quantity.integer' => 'Số lượng sản phẩm phải là số nguyên.',
            'cart_items.*.quantity.gt' => 'Số lượng sản phẩm phải lớn hơn 0.',

            'fullname.required' => 'Họ và tên không được để trống.',
            'fullname.string' => 'Họ và tên phải là chuỗi ký tự.',
            'fullname.max' => 'Họ và tên không được vượt quá 255 ký tự.',

            'email.string' => 'Email phải là chuỗi ký tự.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',

            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.string' => 'Số điện thoại phải là chuỗi ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',

            'company.string' => 'Công ty phải là chuỗi ký tự.',
            'company.max' => 'Công ty không được vượt quá 255 ký tự.',

            'postal_code.string' => 'Mã bưu điện phải là chuỗi ký tự.',
            'postal_code.max' => 'Mã bưu điện không được vượt quá 255 ký tự.',

            'coupon_id.integer' => 'Mã giảm giá phải là số nguyên.',
            'coupon_id.exists' => 'Mã giảm giá không tồn tại.',

            'address_line.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address_line.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'province_code.required' => 'Tỉnh/Thành phố không được để trống.',
            'province_code.in' => 'Tỉnh/Thành phố không hợp lệ.',

            'district_code.required' => 'Quận/Huyện không được để trống.',
            'district_code.in' => 'Quận/Huyện không hợp lệ.',

            'ward_code.required' => 'Phường/Xã không được để trống.',
            'ward_code.in' => 'Phường/Xã không hợp lệ.',

            'shipping_option_id.required' => 'Phương thức vận chuyển không được để trống.',
            'shipping_option_id.exists' => 'Phương thức vận chuyển không tồn tại.',

            'payment_option_id.required' => 'Phương thức thanh toán không được để trống.',
            'payment_option_id.exists' => 'Phương thức thanh toán không tồn tại.',

            'order_channel.required' => 'Kênh đặt hàng không được để trống.',
            'order_channel.array' => 'Kênh đặt hàng phải là mảng.',

            'order_channel.type.required' => 'Loại kênh đặt hàng không được để trống.',
            'order_channel.type.in' => 'Loại kênh đặt hàng không hợp lệ.',

            'order_channel.reference_id.string' => 'Mã tham chiếu phải là chuỗi ký tự.',

            'total_price.required' => 'Tổng giá không được để trống.',
            'total_price.numeric' => 'Tổng giá phải là số.',
            'total_price.gte' => 'Tổng giá phải lớn hơn hoặc bằng 0.',

            'total_quantity.required' => 'Tổng số lượng không được để trống.',
            'total_quantity.integer' => 'Tổng số lượng phải là số nguyên.',
            'total_quantity.gte' => 'Tổng số lượng phải lớn hơn hoặc bằng 1.',

            'user_note.string' => 'Ghi chú khách hàng phải là chuỗi ký tự.',
            'user_note.max' => 'Ghi chú khách hàng không được vượt quá 500 ký tự.',

            'admin_note.string' => 'Ghi chú quản trị phải là chuỗi ký tự.',
            'admin_note.max' => 'Ghi chú quản trị không được vượt quá 500 ký tự.',
        ];
    }

}