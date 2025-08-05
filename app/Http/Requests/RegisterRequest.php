<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:6|confirmed',
            'phone_number'  => 'required|string|unique:users,phone_number',
            'birthday'      => 'nullable|date',
            'genders'       => 'required|in:0,1', // 0: Nữ, 1: Nam
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'Vui lòng nhập họ và tên.',
            'email.required'        => 'Vui lòng nhập email.',
            'email.email'           => 'Email không đúng định dạng.',
            'email.unique'          => 'Email đã được sử dụng.',
            'password.required'     => 'Vui lòng nhập mật khẩu.',
            'password.min'          => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed'    => 'Mật khẩu xác nhận không khớp.',
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'phone_number.unique'   => 'Số điện thoại đã được sử dụng.',
            'birthday.date'         => 'Ngày sinh không hợp lệ.',
            'genders.required'      => 'Vui lòng chọn giới tính.',
            'genders.in'            => 'Giới tính không hợp lệ.',
        ];
    }
}
