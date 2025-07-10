<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\UpdateSubCategoryRequestInterface;
use Illuminate\Validation\Rule;

class UpdateSubCategoryRequest extends BaseFormRequest implements UpdateSubCategoryRequestInterface
{
    public function rules(): array
    {

        // dd($this->all());
        $id = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => [ 'required', 'string', 'max:255', Rule::unique('sub_categories', 'slug')->ignore($id)],

            'category_id' => ['required', 'exists:categories,id'],

            'description' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'status' => boolval($this->status) ? ActivationStatus::ACTIVE : ActivationStatus::INACTIVE,
        ]);
    }

    public function imageFile()
    {
        return $this->null;
    }
}



