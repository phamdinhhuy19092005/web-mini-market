<?php

namespace App\Http\Requests\Backoffice;

use App\Http\Requests\Backoffice\Interfaces\StoreAdminRequestInterface;
use Illuminate\Validation\Rule;

class StoreAdminRequest extends BaseFormRequest implements StoreAdminRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','email','max:255', Rule::unique('admins', 'email')],
            'password' => ['required','string'],
        ];
    }

    public function prepareForValidation()
    {
        return null;
    }

    public function imageFile()
    {
        return null;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Họ và tên không được để trống.',
            'name.string' => 'Họ và tên phải là chuỗi ký tự.',
            'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',

            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã tồn tại, vui lòng chọn email khác.',

            'password.required' => 'Mật khẩu không được để trống.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
        ];
    }
}
