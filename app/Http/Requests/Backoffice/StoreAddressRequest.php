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
}
