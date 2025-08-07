<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreCategoryGroupRequestInterface;
use Illuminate\Validation\Rule;

class StoreCategoryGroupRequest extends BaseFormRequest implements StoreCategoryGroupRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:category_groups,slug'],

            'image' => ['required', 'array'],
            'image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'image.path' => ['nullable', 'string'],

            'cover' => ['required', 'array'],
            'cover.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'cover.path' => ['nullable', 'string'],

            'banner' => ['required', 'array'],
            'banner.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'banner.path' => ['nullable', 'string'],

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
        return $this->file('image', 'cover', 'banner');
    }
}
