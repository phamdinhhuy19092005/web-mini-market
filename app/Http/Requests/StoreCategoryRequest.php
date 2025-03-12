<?php

namespace App\Http\Requests;

use App\Enum\ActivationStatus;
use App\Http\Requests\Interfaces\StoreCategoryRequestInterface;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends BaseFormRequest implements StoreCategoryRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:category_groups,slug'],

            'category_group_id' => ['required', 'exists:category_groups,id'],

            'image' => ['required', 'array'],
            'image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'image.path' => ['nullable', 'string'],

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
        return $this->file('image');
    }
}

