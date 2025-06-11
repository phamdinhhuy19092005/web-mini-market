<?php

namespace App\Http\Requests;

use App\Http\Requests\Interfaces\StoreRoleRequestInterface;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class StoreRoleRequest extends BaseFormRequest implements StoreRoleRequestInterface
{
   public function rules(): array
    {
        return [
            'name' => ['required','string','max:255',Rule::unique('roles', 'name')],
            'permissions' => ['sometimes','array'],
            'permissions.*' => ['string',Rule::exists(Permission::class, 'name')],
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
        return null;
    }
}
