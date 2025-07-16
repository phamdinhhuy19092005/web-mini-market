<?php

namespace App\Http\Requests\Backoffice;

use App\Http\Requests\Backoffice\Interfaces\StoreUserRequestInterface;
use Illuminate\Validation\Rule;

class StoreUserRequest extends BaseFormRequest implements StoreUserRequestInterface
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
}
