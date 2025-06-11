<?php

namespace App\Http\Requests;

use App\Http\Requests\Interfaces\UpdateAdminRequestInterface;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends BaseFormRequest implements UpdateAdminRequestInterface
{
    public function rules(): array
    {
        $adminId = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','email','max:255',Rule::unique('admins', 'email')->ignore($adminId)],
            'password' => ['nullable', 'string', 'min:8'], 
            'roles' => ['sometimes', 'array'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this->input('name')),
        ]);
    }

    public function imageFile()
    {
        return $this->file('image');
    }

}
