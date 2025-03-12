<?php

namespace App\Http\Requests;

use App\Enum\ActivationStatus;
use App\Http\Requests\Interfaces\UpdateCategoryGroupRequestInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;

class UpdateCategoryGroupRequest extends BaseFormRequest implements UpdateCategoryGroupRequestInterface
{
    public function rules(): array
    {
        $id = $this->route('id');
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('category_groups', 'slug')->ignore($id)],
            'image' => ['nullable', 'array'],
            'image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'image.path' => ['nullable', 'string', 'max:255'],
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
        return $this->file('image.file');
    }
}
