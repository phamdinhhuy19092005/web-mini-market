<?php

namespace App\Http\Requests\Backoffice;

use App\Http\Requests\Backoffice\Interfaces\UpdateUserRequestInterface;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends BaseFormRequest implements UpdateUserRequestInterface
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone_number' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('users', 'phone_number')->ignore($this->user?->id ?? $this->route('user'))
            ],
            'access_channel_type' => ['required', 'string'],
            'allow_login' => ['required', 'boolean'],
            'birthday' => ['nullable', 'date', 'before:tomorrow'],
            'genders' => ['required', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'name.string' => 'Tên phải là chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'phone_number.string' => 'Số điện thoại phải là chuỗi ký tự.',
            'phone_number.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'phone_number.unique' => 'Số điện thoại này đã được sử dụng.',
            'access_channel_type.required' => 'Kênh truy cập không được để trống.',
            'allow_login.required' => 'Bạn phải chọn trạng thái cho phép đăng nhập.',
            'allow_login.boolean' => 'Giá trị cho phép đăng nhập không hợp lệ.',
            'birthday.date' => 'Ngày sinh không hợp lệ.',
            'birthday.before' => 'Ngày sinh phải trước ngày hôm nay.',
            'genders.required' => 'Giới tính không được để trống.',
            'genders.in' => 'Giới tính không hợp lệ.',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('birthday') && $this->birthday) {
            $this->merge([
                'birthday' => \Carbon\Carbon::createFromFormat('m/d/Y', $this->birthday)->format('Y-m-d')
            ]);
        }
    }

    public function imageFile()
    {
        return null;
    }
}
