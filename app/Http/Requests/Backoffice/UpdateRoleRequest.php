<?php

namespace App\Http\Requests\Backoffice;

use App\Http\Requests\Backoffice\Interfaces\UpdateRoleRequestInterface;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class UpdateRoleRequest extends BaseFormRequest implements UpdateRoleRequestInterface
{
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255',Rule::unique('roles', 'name')->ignore($this->route('id'))],
            'permissions' => ['sometimes','array'],
            'permissions.*' => ['string',Rule::exists(Permission::class, 'name')],
        ];
    }

    public function imageFile()
    {
        return null;
    }
}