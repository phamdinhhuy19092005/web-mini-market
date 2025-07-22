<?php

namespace App\Http\Requests\Backoffice;

use App\Http\Requests\Backoffice\Interfaces\UpdateUserRequestInterface;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends BaseFormRequest implements UpdateUserRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'access_channel_type' => ['required', 'string'],
            'allow_login' => ['required', 'boolean'],
            'birthday' => ['nullable', 'date', 'before:tomorrow'],
            'genders' => ['required', 'in:0,1'],
        ];
    }
    

    public function imageFile()
    {
        return null;
    }

}
