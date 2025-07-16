<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\ProductTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreProductRequestInterface;
use Illuminate\Validation\Rule;

class StoreProductRequest extends BaseFormRequest implements StoreProductRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [    
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($this->product)],
            'code' => ['nullable', 'string', 'max:100', 'unique:products,code'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'type' => ['required', Rule::in(ProductTypeEnum::all())],

            'primary_image' => ['nullable', 'array'],
            'primary_image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'primary_image.path' => ['nullable', 'string', 'max:255'],

            'media' => ['nullable', 'array'],
            'media.path' => ['nullable', 'array'],
            'media.path.*' => ['nullable', 'string', 'max:255'],
            'media.file' => ['nullable', 'array'],
            'media.file.*' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],

            'suggested_relationships' => ['nullable', 'array'],
            'suggested_relationships.*' => ['integer', 'exists:products,id'],

            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['exists:categories,id'],

            'subcategory_ids' => ['required', 'array'],
            'subcategory_ids.*' => ['exists:sub_categories,id'],
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
