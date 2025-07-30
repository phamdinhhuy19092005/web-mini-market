<?php

namespace App\Http\Requests\Backoffice;

use App\Http\Requests\Backoffice\Interfaces\UpdateAddressRequestInterface;

class UpdateAddressRequest extends BaseFormRequest implements UpdateAddressRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'user_id'       => ['required', 'exists:users,id'],
            'name'          => ['required', 'string', 'max:255'],
            'phone'         => ['required', 'regex:/^(0|\+84)[0-9]{9}$/'],
            'province_code' => ['required', 'exists:provinces,code'],
            'district_code' => ['required', 'exists:districts,code'],
            'ward_code'     => ['required', 'exists:wards,code'],
            'address_line'  => ['required', 'string', 'max:500'],
            'is_default'    => ['nullable', 'boolean'],
        ];
    }

    public function imageFile()
    {
        return null;
    }
}
