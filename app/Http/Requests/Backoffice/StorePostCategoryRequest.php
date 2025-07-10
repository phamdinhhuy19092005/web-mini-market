<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationFE;
use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StorePostCategoryRequestInterface;
use Illuminate\Validation\Rule;

class StorePostCategoryRequest extends BaseFormRequest implements StorePostCategoryRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:post_categories,slug'],

            'image' => ['required', 'array'],
            'image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'image.path' => ['nullable', 'string'],

            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer'],
            'display_on_frontend' => ['required', Rule::in(ActivationFE::all())],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN)
                ? ActivationStatus::ACTIVE
                : ActivationStatus::INACTIVE,

            'display_on_frontend' => filter_var($this->display_on_frontend, FILTER_VALIDATE_BOOLEAN)
                ? ActivationFE::ACTIVE
                : ActivationFE::INACTIVE,
        ]);
    }

    
    public function imageFile()
    {
        return $this->file('image.file');
    }
}
