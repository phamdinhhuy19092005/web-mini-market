<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\ProductTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\UpdateProductRequestInterface;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends BaseFormRequest implements UpdateProductRequestInterface
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:100', Rule::unique('products', 'code')->ignore($this->route('id'))],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'type' => ['required', Rule::in(ProductTypeEnum::all())],
            'primary_image' => ['nullable', 'string', 'max:255'],

            'media' => ['nullable', 'array'],
            'media.path' => ['nullable', 'array'],
            'media.path.*' => ['nullable', 'string', 'max:255'],
            'media.file' => ['nullable', 'array'],
            'media.file.*' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],

            'suggested_relationships' => ['nullable', 'array'],
            'suggested_relationships.*' => ['integer', 'exists:products,id'],

            'primary_image' => ['nullable', 'array'],
            'primary_image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'primary_image.path' => ['nullable', 'string'],

            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['exists:categories,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN)
                ? ActivationStatus::ACTIVE
                : ActivationStatus::INACTIVE,
            'type' => filter_var($this->type, FILTER_VALIDATE_BOOLEAN)
                ? ProductTypeEnum::SIMPLE
                : ProductTypeEnum::VARIABLE,
        ]);
    }


    public function imageFile()
    {
        return $this->input(['primary_image.file', 'media.file']);
    }
}
