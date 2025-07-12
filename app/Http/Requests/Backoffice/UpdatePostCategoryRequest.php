<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\ActivationFE;
use App\Http\Requests\Backoffice\Interfaces\UpdatePostCategoryRequestInterface;
use Illuminate\Validation\Rule;

class UpdatePostCategoryRequest extends BaseFormRequest implements UpdatePostCategoryRequestInterface
{
    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
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

    public function prepareForValidation(): void
    {
        $this->merge([
            'status' => boolval($this->input('status')) ? ActivationStatus::ACTIVE : ActivationStatus::INACTIVE,
            'display_on_frontend' => boolval($this->input('display_on_frontend')) ? ActivationFE::ACTIVE : ActivationFE::INACTIVE,
        ]);
    }

    public function imageFile()
    {
        return $this->file('image.file');
    }
}