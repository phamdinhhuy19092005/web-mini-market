<?php

namespace App\Http\Requests;

use App\Http\Requests\Interfaces\StoreAdminRequestInterface;
use Illuminate\Validation\Rule;

class StoreAdminRequest extends BaseFormRequest implements StoreAdminRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins', 'email'),
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }

     public function prepareForValidation()
    {
    }

    public function imageFile()
    {
    }
}
