<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreSubCategoryRequestInterface;
use Illuminate\Validation\Rule;

class StoreSubCategoryRequest extends BaseFormRequest implements StoreSubCategoryRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:sub_categories,slug'],

            'category_id' => ['required', 'exists:categories,id'],

            'description' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
        ];
    }

    public function prepareForValidation()
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

